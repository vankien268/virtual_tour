<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Location;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Str;

class NewController extends Controller
{
    private $model;
    private $location;
    private $language;
    public function __construct(News $model, Location $location, Language $language)
    {
        $this->language = $language;
        $this->location = $location;
        $this->model = $model;
        $this->middleware('role_or_permission:Super Admin|Danh sách tin tức', ['only' => ['index']]);
        $this->middleware('role_or_permission:Super Admin|Thêm tin tức', ['only' => ['create']]);
        $this->middleware('role_or_permission:Super Admin|Sửa tin tức', ['only' => ['edit']]);
        $this->middleware('role_or_permission:Super Admin|Xóa tin tức', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model->orderBy("id", "ASC")->paginate(10);
        return view('cms.New.index', [
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
        return view('cms.New.create', [
            'languages' => $languages,
            'locations' => $locations
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
        $urlImage = $this->uploadImage($image);
        $data['image'] = $urlImage;
        $data['slug'] = Str::of($data['name'])->slug('-');
        $check = $this->model->where('language_id', $request->language_id)->where('name', $request->name)->first();
        if($check) return redirect()->back()->with('error', 'Bài tin đã tồn tại')->withInput();
        $create = $this->model->create($data);
        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới bài tin thất bại')->withInput();
        }
        return redirect()->route('cms.news.index')->with('success', 'Thêm mới bài tin thành công');
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'language_id' => 'required',
            'name' => ['required', Rule::unique('news')->whereNull('deleted_at')],
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rule, [
            'location_id.required' => 'Địa điểm không được để trống',
            'language_id.required' => 'Ngôn ngữ không được để trống',
            'name.required' => 'Tên không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'image.required' => 'Ảnh đại diện không được để trống',
            'image.mimes' => 'Ảnh đại diện không đúng định dạng (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Dung lượng ảnh quá lớn tối da 2048Kb',
            'name.unique' => 'Tên bài tin đã tồn tại',
        ]);
    }
    private function uploadImage($file)
    {
        $path = $file->store('images');
        return $path;
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
     * @param  \App\Models\RelatedLocation  $relatedLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $languages = $this->language->all();
        $locations = $this->location->all();
        $record = $this->model->find($id);
        return view('cms.New.edit', [
            'locations' => $locations,
            'languages' => $languages,
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
        if(!$record) return redirect()->back()->with('error', 'bài tin không tồn tại')->withInput();
        $check = $this->model->where('language_id', $record->language_id)->where('name', $request->name)->where('id', '!=', $record->id)->first();
        if($check) return redirect()->back()->with('error', 'Bài tin đã tồn tại')->withInput();
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $urlImage = $this->uploadImage($image);
            $data['image'] = $urlImage;
        }
        $data['slug'] = Str::of($data['name'])->slug('-');
        $update = $record->update($data);
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật bài tin thất bại')->withInput();
        }
        return redirect()->route('cms.news.edit', ['id' => $record->id])->with('success', 'Cập nhật bài tin thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'name' => 'required|unique:news,name,' . $request->id,
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $this->validate($request, $rule, [
            'location_id.required' => 'Địa điểm không được để trống',
            'language_id.required' => 'Ngôn ngữ không được để trống',
            'name.required' => 'Tên không được để trống',
            'content.required' => 'Nội dung không được để trống',
            'image.required' => 'Ảnh đại diện không được để trống',
            'image.mimes' => 'Ảnh đại diện không đúng định dạng (jpeg,png,jpg,gif,svg)',
            'image.max' => 'Dung lượng ảnh quá lớn tối da 2048Kb',
            'name.unique' => 'Tên bài tin đã tồn tại',
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
        if(!$record) return redirect()->back()->with('error', 'bài tin không tồn tại')->withInput();
        $delete = $record->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa bài tin thất bại')->withInput();
        }
        return redirect()->route('cms.news.index')->with('success', 'Xóa bài tin thành công');
    }
}
