<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Jobs\ScanJob;
use App\Models\Language;
use App\Models\Location;
use App\Models\Presentation;
use App\Models\RelatedLocation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PresentationController extends Controller
{
    public function index(Request $request, $id)
    {
        $getip = Helper::get_ip();
//        dd($getip);
        $domain = $request->getHttpHost();
        $lang_id_session = $request->session()->get('currentLanguage');
        #id ngôn ngữ theo cookie hoặc session
        $language = Language::findByCode($lang_id_session);
        $related = RelatedLocation::select('related_location_id')->where('location_id', $id)->get()->toArray();
        $related_locations = Location::whereIn('id', $related)->get();

        #ngôn ngữ mặc định
        $lang_default = Language::where('default',1)->first();
        $pre_default = Presentation::where('location_id', $id)
            ->where('language_id', $lang_default->id)
            ->where('status', 1)
            ->first();
        if (!$language) {
            $presentation = null;//Todo Return something
            #ds địa danh
            $list_locations = null;
            $presentation_others = null;
            $presentation_next = null;
            $zone_locations = null;
            $presentation_zones = null;
        } else {
            $presentation = Presentation::where('location_id', $id)
                ->where('language_id', $language->id)
            ->where('status', 1)
                ->first();
            #ds địa danh
            $list_locations = Location::where('status', 1)->get();
            $presentation_others = Presentation::where('location_id', $id)
                ->where('language_id', $language->id)
                ->where('status', 1)
                ->orderBy('position','ASC')
                ->get();
            #ds thuyết minh lân cận
            $presentation_next = Presentation::where('language_id', $language->id)
                ->whereIn('location_id', $related)
                ->where('status', 1)
                ->orderBy('position','ASC')
                ->get();
            $zone_id = $presentation ? $presentation->location ? $presentation->location->zone_id : null : null;

            #ds địa danh cùng hệ thống
            $zone_locations = $zone_id == null ?
                null : Location::select('id')
                    ->where('status', 1)
                    ->where('zone_id', $zone_id)
                    ->orderBy('position','ASC')
                    ->orderBy('id','ASC')
                    ->get();

//            #ds top địa danh
//            $zone_locations = $zone_id == null ?
//                null : Location::select('id')
//                    ->where('status', 1)
//                    ->where('zone_id', $zone_id)
//                    ->whereNotNull('top')
//                    ->orderBy('top','ASC')
//                    ->orderBy('id','ASC')
//                    ->get();

            #ds thuyết minh cùng hệ thống
            $presentation_zones = $zone_locations ? Presentation::where('language_id', $language->id)
                ->whereIn('location_id', $zone_locations->toArray())
                ->where('status', 1)
                ->orderBy('position','ASC')
                ->get() : null;
        }
        #scan
        if ($presentation != null) {
            dispatch(new ScanJob(
                    $presentation,
                    $getip,
                    $request->header('User-Agent')
                )
            )->delay(Carbon::now()->addSecond(10));
        }

//        dump($presentation);
//        dump($pre_default->overview);
        return view('pages.presentation')->with([
            'presentation' => $presentation,
            'related_locations' => $related_locations,
            'zone_locations' => $zone_locations,
            'list_locations' => $list_locations,
            'domain' => $domain,
            'presentation_others' => $presentation_others,
            'presentation_next' => $presentation_next,
            'presentation_zones' => $presentation_zones,
            'pre_default' => $pre_default,
        ]);
    }

}
