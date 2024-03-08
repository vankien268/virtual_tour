<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $model;
    private $location;
    private $language;
    public function __construct(Setting $model, Location $location, Language $language)
    {
        $this->model = $model;
        $this->language = $language;
        $this->location = $location;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model->orderBy("id", "ASC")->paginate(10);
        return view('cms.St.index', [
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
        $languages = $this->language->all();
        $locations = $this->location->all();
        return view('cms.St.create', [
            'languages' => $languages,
            'locations' => $locations,
        ]);
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
            return redirect()->back()->with('error', 'Thêm mới thất bại')->withInput();
        }
        return redirect()->route('cms.settings.index')->with('success', 'Thêm mới thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'language_id' => 'required',
            'location_id' => 'required',
            'key' => 'required',
            'value' => 'required'
        ];
        $this->validate($request, $rule, [
            'language_id.required' => 'Ngôn ngữ không được để trống',
            'location_id.required' => 'Địa điểm vùng không được để trống',
            'key.required' => 'Key vùng không được để trống',
            'value.required' => 'Value không được để trống',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $record = $this->model->find($request->id);
        $locations = $this->location->all();
        $languages = $this->language->all();
        return view('cms.ST.edit', [
            'record' => $record,
            'locations' => $locations,
            'languages' => $languages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'value' => 'required'
        ], [
            'key.required' => 'Key không được để trống',
            'value.required' => 'Value không được để trống',
        ]);
        $setting = $this->model->find($request->id);
        $update = $setting->update($request->all());
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật mới thất bại')->withInput();
        }
        return redirect()->back()->with('success', 'Cập nhật mới thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $model = $this->model->find($id);
        if(!$model) return redirect()->back()->with('error', 'Setting không tồn tại')->withInput();
        $delete = $model->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa thất bại')->withInput();
        }
        return redirect()->route('cms.settings.index')->with('success', 'Xóa thành công');
    }
}
