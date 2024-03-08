<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Session;

class UserSpatieController extends Controller
{
    private $user;
    private $role;
    private $permission;
    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->user = $user;
        $this->middleware('role:Super Admin|Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->user->with(['roles', 'permissions'])->orderBy("id", "ASC")->where('id', '!=', 1)->paginate(5);
        return view('cms.User.index', [
            'records' => $records,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 1)->get();
        return view('cms.User.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $data['password']= Hash::make($data['password']);
        $create = $this->user->create($data);
        $create->assignRole($request->role);
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới người dùng thất bại')->withInput();
        }
        return redirect()->route('cms.manager.users.index')->with('success', 'Thêm mới người dùng thành công');
    }
    private function validateStore(Request $request)
    {
        $rule = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên người dùng không được để trống',
            'email.required' => 'Username không được để trống',
            'password.required' => 'Password không được để trống',
            'role.required' => 'Vai trò không được để trống'
        ]);
    }
    
    /**
     * form thêm role. permission cho user
     *
     * @param  mixed $id
     * @return void
     */
    public function rolePermission($id)
    {
        $user = $this->user->find($id);
        $roles = $this->role->where('name', '!=', 'Super Admin')->get();
        $permissions = $this->permission->whereNotIn('name', ['Danh sách khu vực', 'Thêm khu vực', 'Xóa khu vực', 'Sửa khu vực', 'Danh sách ngôn ngữ', 'Sửa ngôn ngữ','Xóa ngôn ngữ','Thêm ngôn ngữ'])->get();
        $userRoles = $user->roles()->get();
        $userPermissions = $user->permissions()->get();
        return view('cms.User.role-permission', [
            'userRoles' => $userRoles,
            'roles' => $roles,
            'user' => $user,
            'permissions' => $permissions,
            'userPermissions' => $userPermissions

        ]);
    }
    
    /**
     * thêm vai trò
     *
     * @param  mixed $request
     * @return void
     */
    public function rolePermissionStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = $this->user->find($data['id']);
            $roles = isset($data['roles']) ? $data['roles'] : [];
            $syncR = $user->syncRoles($roles);
    
            $permissions = isset($data['permissions']) ? $data['permissions'] : [];
            $syncP = $user->syncPermissions($permissions);
            if (!$syncR || !$syncP) {
                return redirect()->back()->with('error', 'Thêm quyền thất bại')->withInput();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Thêm quyền thành công')->withInput();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---line: ' . $exception->getLine());
            // alert()->error('Lỗi', 'Message: ' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
            return redirect()->back()->with('error', 'Exception')->withInput();
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->user->find($id);
        return view('cms.User.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $record = $this->user->find($request->id);
        $update = $record->update($request->all());
        return redirect()->back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $record = $this->user->find($request->id);
        $record->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
    
    /**
     * changePassword
     *
     * @return void
     */
    public function changePassword(Request $request)
    {
        $id = $request->id;
        $pass = $request->password;
        $user = $this->user->find($id);
        $update = $user->update(['password' => Hash::make($pass)]);
        if(!$update) return redirect()->back()->with('error', 'Đổi mật khẩu thất bại');
        // if(Auth::user()->id == $id) Auth::logout();
        return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
    }
    
    /**
     * renderPermission
     *
     * @param  mixed $request
     * @return void
     */
    public function renderPermission(Request $request)
    {
        $id = $request->roleIds ? $request->roleIds : [];
        $roles = Role::whereIn('id', $id)->get();
        $permissions = $this->permission->whereNotIn('name', ['Danh sách khu vực', 'Thêm khu vực', 'Xóa khu vực', 'Sửa khu vực', 'Danh sách ngôn ngữ', 'Sửa ngôn ngữ','Xóa ngôn ngữ','Thêm ngôn ngữ'])->get();
        $view =  view('cms.User.Component.user-permission', [
            'userRoles' => $roles ? $roles : [],
            'permissions' => $permissions
        ])->render();
        return response()->json(array('success' => true, 'html' => $view));
    }
}
