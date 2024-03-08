<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Location;
use App\Models\News;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $baseUrl = url()->current();
        $value = $request->cookie('lang_id');
        $lang_id_session = $request->session()->get('currentLanguage');
        #id ngôn ngữ theo cookie hoặc session
        $language = Language::findByCode($lang_id_session);

        #ds top địa danh
        $top_locations = $language ?
             Location::select('id')
                ->where('status', 1)
                ->whereNotNull('top')
                ->orderBy('top','ASC')
                ->orderBy('id','ASC')
                ->get() : null;

//        dd($top_locations);
        $presentations = $language? Presentation::where('language_id',$language->id)
            ->orderBy('position','ASC')
//            ->limit(5)
            ->get() : null;
        $posts = $language? News::where('language_id',$language->id)
            ->orderBy('position','ASC')
            ->limit(8)->get() : null;
//        dd($top_locations);
        return view('pages/home')->with([
            'presentations'=>$presentations,
            'posts'=>$posts,
            'top_locations'=>$top_locations,
        ]);
    }
}
