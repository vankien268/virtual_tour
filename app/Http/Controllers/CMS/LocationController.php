<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\RelatedLocation;
use App\Models\Zone;
use Illuminate\Http\Request;
use chillerlan\QRCode\{QRCode, QRCodeException, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\{QROutputInterface, QRMarkupSVG};
use Str;


class LocationController extends Controller
{
    private $model;
    private $zone;
    public function __construct(Location $model, Zone $zone)
    {
        $this->zone = $zone;
        $this->model = $model;
        $this->middleware('role_or_permission:Super Admin|Danh sách địa điểm', ['only' => ['index']]);
        $this->middleware('role_or_permission:Super Admin|Thêm địa điểm', ['only' => ['create']]);
        $this->middleware('role_or_permission:Super Admin|Sửa địa điểm', ['only' => ['edit']]);
        $this->middleware('role_or_permission:Super Admin|Xóa địa điểm', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $zoneIds = $request->zoneIds;
        $zones = $this->zone->all();

        $records = $this->model->with(['presentations'])->withCount(['scannings']);

        $records = $records->orderBy("id", "ASC")->paginate(10);

        return view('cms.Location.index', [
            'records' => $records,
            'zones' => $zones
        ]);
    }

    /**
     * rederTable
     *
     * @return void
     */
    public function renderTable(Request $request)
    {
        $zoneIds = $request->zoneIds;
        $zones = $this->zone->all();

        $records = $this->model->with(['presentations']);

        if ($zoneIds) {
            if (count($zoneIds) != 0) {
                $records = $records->whereIn('zone_id', $request->zoneIds);
            }
        }
        $records = $records->orderBy("id", "ASC")->paginate(10);
        $view = view('cms.Location.Component.record-table', [
            'records' => $records,
            'zones' => $zones,
            'zoneIds' => $zoneIds
        ])->render();
        return response()->json(array('success' => true, 'html'=>$view));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = $this->zone->all();
        $locations = $this->model->all();
        return view('cms.Location.create', [
            'zones' => $zones,
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
        $btn = $request->btn;
        $related = $request->related;
        $this->storeValidate($request);
        $create = $this->model->create($request->all());
        if ($related) {
            foreach ($related as $key => $value) {
                $positionRelated = RelatedLocation::where('location_id', $create->id)->count();
                RelatedLocation::create([
                    'location_id' => $create->id,
                    'related_location_id' => $value,
                    'position' => $positionRelated+1
                ]);
            }
        }

        if (!$create) {
            return redirect()->back()->with('error', 'Thêm mới địa điểm thất bại')->withInput();
        }
        if ($btn == 'location') {
            return redirect()->route('cms.locations.index')->with('success', 'Thêm mới địa điểm thành công');
        } else {
            return redirect()->route('cms.presentations.create', ['id' => $create->id])->with('success', 'Thêm mới địa điểm thành công');
        }
    }
    private function storeValidate(Request $request)
    {
        $rule = [
            'zone_id' => 'required',
            'name' => 'required',
            'position' => 'required',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'zone_id.required' => 'Vùng không được để trống',
            'lat.required' => 'Lat không được để trống',
            'long.required' => 'Long không được để trống',
            'position.required' => 'Vị trí không được để trống',
            'overview.required' => 'Mô tả không được để trống',
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
        $record = $this->model->find($id);
        $zones = $this->zone->all();
        $locations = $this->model->all();
        if(!$record) return redirect()->back()->with('error', 'Vùng bạn chọn không tồn tại')->withInput();
        return view('cms.Location.edit', [
            'record' => $record,
            'zones' => $zones,
            'locations' => $locations
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
        $related = $request->related ? $request->related : [];
        $id = $request->id;
        $record = $this->model->find($id);
        $locationRelated = $record->relatedLoactions()->pluck('related_location_id')->toArray();
        if (count($locationRelated) > 0) {
            foreach ($locationRelated as $key => $value) {
                if (!in_array($value, $related)) {
                    $row = RelatedLocation::where('related_location_id',$value)->where('location_id', $id)->first();
                    $row->delete();
                }
            }
        }
        if (count($related) > 0) {
            foreach ($related as $key => $value) {
                if (!in_array($value, $locationRelated)) {
                    $positionRelated = RelatedLocation::where('location_id', $id)->count();
                    RelatedLocation::create([
                    'location_id' => $id,
                    'related_location_id' => $value,
                    'position' => $positionRelated+1
                    ]);
                }
            }
        }

        if(!$record) return redirect()->back()->with('error', 'Địa điểm không tồn tại')->withInput();
        $update = $record->update($request->all());
        if (!$update) {
            return redirect()->back()->with('error', 'Cập nhật địa điểm thất bại')->withInput();
        }
        return redirect()->route('cms.locations.edit', ['id' => $record->id])->with('success', 'Cập nhật địa điểm thành công');
    }
    private function updateValidate(Request $request)
    {
        $rule = [
            'name' => 'required',
            'position' => 'required',
        ];
        $this->validate($request, $rule, [
            'name.required' => 'Tên không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'lat.required' => 'Lat không được để trống',
            'long.required' => 'Long không được để trống',
            'position.required' => 'Vị trí không được để trống',
            'overview.required' => 'Mô tả không được để trống',
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
        $record = $this->model->find($id);
        if(!$record) return redirect()->back()->with('error', 'Địa điểm không tồn tại')->withInput();
        $presentation = $record->presentations()->delete();
        $delete = $record->delete();
        if (!$delete) {
            return redirect()->back()->with('error', 'Xóa địa điểm thất bại')->withInput();
        }
        return redirect()->route('cms.locations.index')->with('success', 'Xóa địa điểm thành công');
    }

    /**
     * renderModalQr
     *
     * @param  mixed $request
     * @return void
     */
    public function renderModalQr(Request $request)
    {
        $options = new SVGWithLogoOptions([
            // SVG logo options (see extended class below)
            'svgLogo'             => asset('logo/logo-bai-dinh.svg'), // logo from: https://github.com/simple-icons/simple-icons
            'svgLogoScale'        => 0.25,
            'svgLogoCssClass'     => 'dark',
            // QROptions
            'version'             => 5,
            'outputType'          => QROutputInterface::CUSTOM,
            'outputInterface'     => QRSvgWithLogo::class,
            'imageBase64'         => false,
            // ECC level H is necessary when using logos
            'eccLevel'            => EccLevel::H,
            'addQuietzone'        => true,
            // if set to true, the light modules won't be rendered
            'drawLightModules'    => true,
            // empty the default value to remove the fill* attributes from the <path> elements
            'markupDark'          => '',
            'markupLight'         => '',
            // draw the modules as circles isntead of squares
            'drawCircularModules' => true,
            'circleRadius'        => 0.45,
            // connect paths
            'connectPaths'     => true,
            // keep modules of thhese types as square
            'keepAsSquare'        => [
                QRMatrix::M_FINDER|QRMatrix::IS_DARK,
                QRMatrix::M_FINDER_DOT,
                QRMatrix::M_ALIGNMENT|QRMatrix::IS_DARK,
            ],
            // https://developer.mozilla.org/en-US/docs/Web/SVG/Element/linearGradient
            'svgDefs'             => '
            <linearGradient id="gradient" x1="100%" y2="100%">
                <stop stop-color="#844029" offset="0"/>
                <stop stop-color="#844029" offset="0.5"/>
                <stop stop-color="#844029" offset="1"/>
            </linearGradient>
            <style><![CDATA[
                .dark{fill: url(#gradient);}
                .light{fill: #FFFFFF;}
            ]]></style>',
        ]);
        $id = $request->id;
        $url = route('locations', $id);
        // dd($url, strlen($url), strlen('https://www.youtube.com/watch?v=dQw4w9WgXcQ'));
        $location = $this->model->find($id);
        $qrcode = (new QRCode($options))->render($url, storage_path('app/qrcode/'.Str::slug($location->name).'.svg'));
        // return $qrcode;
        // $qrcode->store('images');
        $view =  view('cms.Location.Component.modal-qr', [
            'qrcode' => $qrcode,
            'location' => $location
        ])->render();
        return response()->json(array('success' => true, 'html' => $view));
    }

    /**
     * downloadQrcode
     *
     * @return void
     */
    public function downloadQrcode(Request $request)
    {
        $id = $request->id;
        $location = $this->model->find($id);
        return response()->download(public_path('qrcode/'.Str::slug($location->name).'.svg'));
    }


}
//---------------------------------------
class QRSvgWithLogo extends QRMarkupSVG{

	/**
	 * @inheritDoc
	 */
	protected function paths():string{
		$size = (int)ceil($this->moduleCount * $this->options->svgLogoScale);

		// we're calling QRMatrix::setLogoSpace() manually, so QROptions::$addLogoSpace has no effect here
		$this->matrix->setLogoSpace($size, $size);

		$svg = parent::paths();
		$svg .= $this->getLogo();

		return $svg;
	}

	/**
	 * returns a <g> element that contains the SVG logo and positions it properly within the QR Code
	 *
	 * @see https://developer.mozilla.org/en-US/docs/Web/SVG/Element/g
	 * @see https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/transform
	 */
	protected function getLogo():string{
		// @todo: customize the <g> element to your liking (css class, style...)
		return sprintf(
			'%5$s<g transform="translate(%1$s %1$s) scale(%2$s)" class="%3$s">%5$s	%4$s%5$s</g>',
			($this->moduleCount - ($this->moduleCount * $this->options->svgLogoScale)) / 2,
			$this->options->svgLogoScale,
			$this->options->svgLogoCssClass,
			file_get_contents($this->options->svgLogo),
			$this->options->eol
		);
	}

}


/**
 * augment the QROptions class
 */
class SVGWithLogoOptions extends QROptions{
	// path to svg logo
	protected string $svgLogo;
	// logo scale in % of QR Code size, clamped to 10%-30%
	protected float $svgLogoScale = 0.20;
	// css class for the logo (defined in $svgDefs)
	protected string $svgLogoCssClass = '';

	// check logo
	protected function set_svgLogo(string $svgLogo):void{

		// if(!file_exists($svgLogo) || !is_readable($svgLogo)){
		// 	throw new QRCodeException('invalid svg logo');
		// }

		// @todo: validate svg

		$this->svgLogo = $svgLogo;
	}

	// clamp logo scale
	protected function set_svgLogoScale(float $svgLogoScale):void{
		$this->svgLogoScale = max(0.05, min(0.3, $svgLogoScale));
	}

}
