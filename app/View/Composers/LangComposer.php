<?php


namespace App\View\Composers;


use App\Models\Language;
use App\Models\Location;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LangComposer
{
    protected $langs;
    protected $lang;

    public function __construct(Language $langs)
    {
        $this->langs = $langs;
    }

    public function compose(View $view)
    {
        $currentLanguage = \session('currentLanguage');
        $currentLanguageObj = Language::findByCode($currentLanguage);
        $location_menus = Location::where('status', 1)->get();
        $langs = Language::where('status', 1)->get();
        $language = Language::findByCode($currentLanguage);
        $settings = $language? Setting::where('language_id',$language->id)->get() :null;

        $lrl = $language ? Setting::where('language_id',$language->id)->where('key','list-related-location')->first() :null;
        $lrz = $language ? Setting::where('language_id',$language->id)->where('key','list-related-zone')->first() :null;
        $arl = $language ? Setting::where('language_id',$language->id)->where('key','alert-related-location')->first() :null;
        $al = $language ? Setting::where('language_id',$language->id)->where('key','alert-location')->first() :null;
        $arz = $language ? Setting::where('language_id',$language->id)->where('key','alert-related-zone')->first() :null;
        $tl = $language ? Setting::where('language_id',$language->id)->where('key','top-location')->first() :null;
        $d = $language ? Setting::where('language_id',$language->id)->where('key','detail')->first() :null;
        $tn = $language ? Setting::where('language_id',$language->id)->where('key','top-news')->first() :null;
        $sm = $language ? Setting::where('language_id',$language->id)->where('key','see-more')->first() :null;
        $h = $language ? Setting::where('language_id',$language->id)->where('key','home')->first() :null;
        $pagoda = $language ? Setting::where('language_id',$language->id)->where('key','pagoda')->first() :null;
        $address = $language ? Setting::where('language_id',$language->id)->where('key','address')->first() :null;
        $fs = Setting::where('key','first-select')->first();
        $view->with([
            'langs' => $langs,
            'currentLanguage' => $currentLanguage,
            'location_menus' => $location_menus,
            'currentLanguageObj' => $currentLanguageObj,
            'lrl' => $lrl,
            'lrz' => $lrz,
            'arl' => $arl,
            'al' => $al,
            'arz' => $arz,
            'tl' => $tl,
            'd' => $d,
            'tn' => $tn,
            'sm' => $sm,
            'h' => $h,
            'settings' => $settings,
            'fs' => $fs,
            'pagoda' => $pagoda,
            'address' => $address,
        ]);
    }
}
