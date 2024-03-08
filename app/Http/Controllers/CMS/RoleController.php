<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->middleware('role:Super Admin|Admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->role->orderBy("id", "ASC")->where('name', '!=', 'Super Admin')->paginate(10);
        return view('cms.Role.index', [
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
        return view('cms.Role.create');
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
        $create = $this->role->create($data);
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới vai trò thất bại')->withInput();
        }
        return redirect()->route('cms.manager.roles.index')->with('success', 'Thêm mới vai trò thành công');
    }
    private function validateStore(Request $request)
    {
        $rule = ['name' => 'required'];
        $this->validate($request, $rule, [
            'name.required' => 'Tên vai trò không để trống'
        ]);
    }

        
    /**
     * form thêm quyền cho vai trò
     *
     * @param  mixed $id
     * @return void
     */
    public function rolePermission($id)
    {
        $role = $this->role->find($id);
        $permissions = $this->permission->whereNotIn('name', ['Danh sách khu vực', 'Thêm khu vực', 'Xóa khu vực', 'Sửa khu vực', 'Danh sách ngôn ngữ', 'Sửa ngôn ngữ','Xóa ngôn ngữ','Thêm ngôn ngữ'])->get();
        $rolePermissions = $role->permissions()->get();
        return view('cms.Role.role-permission', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }
    
    /**
     * thêm quyền cho vai trò
     *
     * @param  mixed $request
     * @return void
     */
    public function rolePermissionStore(Request $request)
    {
        $data = $request->all();
        $role = $this->role->find($data['id']);
        $permissions = isset($data['permissions']) ? $data['permissions'] : '';
        $syncP = $role->syncPermissions($permissions);
        if (!$syncP) {
            return redirect()->back()->with('error', 'Thêm quyền thất bại')->withInput();
        }
        return redirect()->back()->with('success', 'Thêm quyền thành công')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
