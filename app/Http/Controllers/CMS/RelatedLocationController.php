<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\RelatedLocation;
use Illuminate\Http\Request;

class RelatedLocationController extends Controller
{
    private $model;
    private $location;
    public function __construct(RelatedLocation $model, Location $location)
    {
        $this->location = $location;
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model->orderBy("id", "ASC")->paginate(10);
        return view('cms.RelatedLocation.index', [
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
        $locations = $this->location->all();
        return view('cms.RelatedLocation.create', [
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
            return redirect()->back()->with('error', 'Thêm mới địa điểm liên quan thất bại')->withInput();
        }
        return redirect()->route('cms.related.locations.index')->with('success', 'Thêm mới địa điểm liên quan thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'location_id' => 'required',
            'related_location_id' => 'required',
            'position' => 'required',
        ];
        $this->validate($request, $rule, [
            'location_id.required' => 'Địa điểm không được để trống',
            'related_location_id.required' => 'Địa điểm liên quan không được để trống',
            'position.required' => 'Vị trí không được để trống',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function show(RelatedLocation $relatedLocation)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $locations = $this->location->all();
        $record = $this->model->find($id);
        return view('cms.RelatedLocation.edit', [
            'locations' => $locations,
            'record' => $record,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->updateValidate($request);
        $id = $request->id;
        $record = $this->model->find($id);
        if(!$record) return redirect()->back()->with('error', 'Địa điểm liên quan không tồn tại')->withInput();
        $update = $record->update($request->all());
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật địa điểm liên quan thất bại')->withInput();
        }
        return redirect()->route('cms.related.locations.edit', ['id' => $record->id])->with('success', 'Cập nhật địa điểm liên quan thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'location_id' => 'required',
            'related_location_id' => 'required',
            'position' => 'required',
        ];
        $this->validate($request, $rule, [
            'location_id.required' => 'Địa điểm không được để trống',
            'related_location_id.required' => 'Địa điểm liên quan không được để trống',
            'position.required' => 'Vị trí không được để trống',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $record = $this->model->find($id);
        if(!$record) return redirect()->back()->with('error', 'địa điểm liên quan không tồn tại')->withInput();
        $delete = $record->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa địa điểm liên quan thất bại')->withInput();
        }
        return redirect()->route('cms.related.locations.index')->with('success', 'Xóa địa điểm liên quan thành công');
    }
}
