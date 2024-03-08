<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\Presentation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresentationController extends Controller
{
    private $model;
    private $language;
    private $location;
    public function __construct(Presentation $model, Language $language, Location $location)
    {
        $this->language = $language;
        $this->model = $model;
        $this->location = $location;
        $this->middleware('role_or_permission:Super Admin', ['only' => ['index']]);
        $this->middleware('role_or_permission:Super Admin|Thêm bài thuyết trình', ['only' => ['create']]);
        $this->middleware('role_or_permission:Super Admin|Sửa bài thuyết trình', ['only' => ['edit']]);
        // $this->middleware('role_or_permission:Super Admin|Admin|Xóa thuyết trình', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model->orderBy("id", "ASC")->paginate(10);
        return view('cms.Presentation.index', [
            'records' => $records,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $location = $this->location->find($request->id);
        $languageIds = $location->presentations()->pluck('language_id');
        $languages = $this->language->whereNotIn('id', $languageIds)->where('status', 1)->get();
        $locations = $this->location->all();
        return view('cms.Presentation.create', [
            'languages' => $languages,
            'locations' => $locations,
            'location' => $location
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
        $data = $request->all();
        $image = $request->file('image');
        $audio = $request->file('audio');
        $urlImage = $this->uploadImage($image);
        $urlAudio = $this->uploadAudio($audio);
        $data['image'] = $urlImage;
        $data['audio'] = $urlAudio;
        $language = $this->language->find($data['language_id']);
        $data['language_code'] = $language->language_code;
        $row = $this->model->where('location_id', $data['location_id'])->where('language_id', $data['language_id'])->first();
        if($row) return redirect()->back()->with('error', 'Bài thuyết trình đã tồn tại')->withInput();

        $create = $this->model->create($data);
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới thuyết minh thất bại')->withInput();
        }
        if($request->btn == 'submit'){
            return redirect()->route('cms.locations.index')->with('success', 'Thêm mới thuyết minh thành công');
        } else {
            return redirect()->back()->with('success', 'Thêm mới thuyết minh thành công');
        }
        // return redirect()->route('cms.presentations.index')->with('success', 'Thêm mới thuyết minh thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'location_id' => 'required',
            'language_id' => 'required',
            'name' => 'required',
            'content' => 'required',
            'audio' => 'required|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rule, [
            'location_id.required' => 'Địa điểm không được để trống',
            'language_id.required' => 'Ngôn ngữ không được để trống',
            'language_id.unique' => 'Bài thuyết trình đã tồn tại',
            'name.required' => 'Tên không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'audio.required' => 'Âm thanh không được để trống',
            'audio.mimes' => 'File âm thanh không đúng định dạng (udio/mpeg,mpga,mp3,wav,aac)',
            'image.required' => 'Ảnh đại diện không được để trống',
            'image.mimes' => 'Ảnh đại diện không đúng định dạng (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Dung lượng ảnh quá lớn tối da 2048Kb',
        ]);
    }
    private function uploadImage($file)
    {
        $path = $file->store('images');
        return $path;
    }
    private function uploadAudio($file)
    {
        $path = $file->store('audios');
        return $path;
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        $languages = $this->language->all();
        $locations = $this->location->all();
        $record = $this->model->find($id);
        $language = $record->language;
        $presentation = Presentation::find($id);
        #ds địa danh
        $list_locations = Location::where('status',1)->get();
        $presentation_others = Presentation::where('location_id',$id)
            ->where('language_id',$language->id)->get();
        #ds thuyết minh lân cận
        // $presentation_next = Presentation::where('language_id',$language->id)
        //     ->whereIn('location_id',$related)->get();
        $zone_id = $presentation ? $presentation->location ? $presentation->location->zone_id : null : null;

        $zone_locations = $zone_id == null ? null : Location::select('id')->where('zone_id', $zone_id)//
        ->get();

        #ds thuyết minh cùng hệ thống
        $presentation_zones = $zone_locations ? Presentation::where('language_id',$language->id)
            ->whereIn('location_id',$zone_locations->toArray())->get() : null;
        #setting
        $settings = Setting::where('language_id',$language->id)->get();
        return view('cms.Presentation.edit', [
            'locations' => $locations,
            'languages' => $languages,
            'record' => $record,
            'presentation' => $presentation,
            'zone_locations' => $zone_locations,
            'list_locations' => $list_locations,
            'presentation_others' => $presentation_others,
            'presentation_zones' => $presentation_zones,
            'settings' => $settings,
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
        if(!$record) return redirect()->back()->with('error', 'thuyết minh không tồn tại')->withInput();
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $urlImage = $this->uploadImage($image);
            // dd($urlImage);
            $data['image'] = $urlImage;
        }
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $urlAudio = $this->uploadAudio($audio);
            $data['audio'] = $urlAudio;
        }
        $update = $record->update($data);
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật thuyết minh thất bại')->withInput();
        }
        return redirect()->route('cms.presentations.edit', ['id' => $record->id])->with('success', 'Cập nhật thuyết minh thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'content' => 'required',
            'audio' => 'mimes:audio/mpeg,mpga,mp3,wav,aac',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'audio.required' => 'Âm thanh không được để trống',
            'audio.mimes' => 'File âm thanh không đúng định dạng (udio/mpeg,mpga,mp3,wav,aac)',
            'image.required' => 'Ảnh đại diện không được để trống',
            'image.mimes' => 'Ảnh đại diện không đúng định dạng (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Dung lượng ảnh quá lớn tối da 2048Kb',
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
        if(!$record) return redirect()->back()->with('error', 'thuyết minh không tồn tại')->withInput();
        $delete = $record->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa thuyết minh thất bại')->withInput();
        }
        return redirect()->route('cms.locations.index')->with('success', 'Xóa thuyết minh thành công');
    }
}
