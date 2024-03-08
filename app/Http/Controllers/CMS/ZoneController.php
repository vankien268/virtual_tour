<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    private $zone;
    public function __construct(Zone $zone)
    {
        $this->zone = $zone;
        $this->middleware('role_or_permission:Super Admin|Admin|Danh sách khu vực', ['only' => ['index']]);
        $this->middleware('role_or_permission:Super Admin|Admin|Thêm khu vực', ['only' => ['create']]);
        $this->middleware('role_or_permission:Super Admin|Admin|Sửa khu vực', ['only' => ['edit']]);
        $this->middleware('role_or_permission:Super Admin|Admin|Xóa khu vực', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = $this->zone->orderBy("id", "ASC")->paginate(10);
        return view('cms.Zone.index', [
            'records' => $zones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.Zone.create');
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
        $create = $this->zone->create($request->all());
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới vùng thất bại')->withInput();
        }
        return redirect()->route('cms.zones.index')->with('success', 'Thêm mới vùng thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'overview' => 'required',
            'status' => 'required'
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên vùng không được để trống',
            'address.required' => 'Địa chỉ vùng không được để trống',
            'overview.required' => 'Mô tả vùng không được để trống',
            'status.required' => 'Trạng thái không được để trống',
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
        $zone = $this->zone->find($id);
        if(!$zone) return redirect()->back()->with('error', 'Vùng bạn chọn không tồn tại')->withInput();
        return view('cms.Zone.edit', [
            'record' => $zone,
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
        $zone = $this->zone->find($id);
        if(!$zone) return redirect()->back()->with('error', 'Vùng không tồn tại')->withInput();
        $update = $zone->update($request->all());
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật vùng thất bại')->withInput();
        }
        return redirect()->route('cms.zones.edit', ['id' => $zone->id])->with('success', 'Cập nhật vùng thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'address' => 'required',
            'overview' => 'required',
            'status' => 'required',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên vùng không được để trống',
            'address.required' => 'Địa chỉ vùng không được để trống',
            'overview.required' => 'Mô tả vùng không được để trống',
            'status.required' => 'Trạng thái không được để trống'
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
        $zone = $this->zone->find($id);
        if(!$zone) return redirect()->back()->with('error', 'Vùng không tồn tại')->withInput();
        $delete = $zone->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa vùng thất bại')->withInput();
        }
        return redirect()->route('cms.zones.index')->with('success', 'Xóa vùng thành công');
    }
}
