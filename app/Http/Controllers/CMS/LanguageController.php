<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{
    private $model;
    public function __construct(Language $language)
    {
        $this->model = $language;
        $this->middleware('role_or_permission:Super Admin|Danh sách ngôn ngữ', ['only' => ['index']]);
        $this->middleware('role_or_permission:Super Admin|Thêm ngôn ngữ', ['only' => ['create']]);
        $this->middleware('role_or_permission:Super Admin|Sửa ngôn ngữ', ['only' => ['edit']]);
        $this->middleware('role_or_permission:Super Admin|Xóa ngôn ngữ', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = $this->model->orderBy("id", "ASC")->paginate(10);
        return view('cms.Lg.index', [
            'records' => $languages
        ]);
    }
    
    /**
     * ngôn ngữ mặc định
     *
     * @return void
     */
    public function default(Request $request)
    {
        $id = $request->id;
        DB::table('languages')->update(['default' => 0]);
        $record = $this->model->find($id);
        $record->update(['default' => 1]);
        return response()->json(array('success' => 'Thành công'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.Lg.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->storeValidate($request);
        $create = $this->model->create($request->all());
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới ngôn ngữ thất bại')->withInput();
        }
        return redirect()->route('cms.languages.index')->with('success', 'Thêm mới ngôn ngữ thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'localization' => 'required',
            'code' => 'required',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên tiếng việt không được để trống',
            'localization.required' => 'Tên theo ngôn ngữ không được để trống',
            'code.required' => 'Mã ngôn ngữ không được để trống',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $language = $this->model->find($id);
        if(!$language) return redirect()->back()->with('error', 'Vùng bạn chọn không tồn tại')->withInput();
        return view('cms.Lg.edit', [
            'record' => $language,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->updateValidate($request);
        $id = $request->id;
        $language = $this->model->find($id);
        if(!$language) return redirect()->back()->with('error', 'Ngôn ngữ không tồn tại')->withInput();
        $update = $language->update($request->all());
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật vùng thất bại')->withInput();
        }
        return redirect()->route('cms.languages.edit', ['id' => $language->id])->with('success', 'Cập nhật vùng thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'localization' => 'required',
            'code' => 'required',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên tiếng việt không được để trống',
            'localization.required' => 'Tên theo ngôn ngữ không được để trống',
            'code.required' => 'Mã ngôn ngữ không được để trống',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $language = $this->model->find($id);
        if(!$language) return redirect()->back()->with('error', 'ngôn ngữ không tồn tại')->withInput();
        $delete = $language->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa ngôn ngữ thất bại')->withInput();
        }
        return redirect()->route('cms.languages.index')->with('success', 'Xóa ngôn ngữ thành công');
    }
}
