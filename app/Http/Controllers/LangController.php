<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LangController extends Controller
{
//    public function setCookie(Request $request){
//        $data = $request->all();
//        $lang =  (!array_key_exists('lang', $data) || $data['lang'] == null) ? null : $data['lang'];
////        $lang_id = cookie('lang_id', $lang, 1);
//        $lang_id = Cookie::queue('lang_id', $lang, 1);
//        $cookie = Cookie::forget('lang_id');
////        $session = Session::forget('lang_id');
//        $lang_id_session = $request-> session()->put('lang_id', $lang);
//        $previous = url()->previous();
////        dd(Str::afterLast($previous,'/'));
////       $cf= Cookie::forget('lang_id');
////       dd($cf);
////       $this->setCookie2($lang);
////        dd($lang);
////        dump('sang');
//        return redirect(route('locations',Str::afterLast($previous,'/')));
////        return $response;
//    }
//
//    public function setCookie2($lang){
//        $minutes = 1;
//        $response = new Response();
//        $response->withCookie('lang_id', $lang, $minutes);
//        return $response;
//
//    }public function setCookie(Request $request){
//        $data = $request->all();
//        $lang =  (!array_key_exists('lang', $data) || $data['lang'] == null) ? null : $data['lang'];
////        $lang_id = cookie('lang_id', $lang, 1);
//        $lang_id = Cookie::queue('lang_id', $lang, 1);
//        $cookie = Cookie::forget('lang_id');
////        $session = Session::forget('lang_id');
//        $lang_id_session = $request-> session()->put('lang_id', $lang);
//        $previous = url()->previous();
////        dd(Str::afterLast($previous,'/'));
////       $cf= Cookie::forget('lang_id');
////       dd($cf);
////       $this->setCookie2($lang);
////        dd($lang);
////        dump('sang');
//        return redirect(route('locations',Str::afterLast($previous,'/')));
////        return $response;
//    }
//
//    public function setCookie2($lang){
//        $minutes = 1;
//        $response = new Response();
//        $response->withCookie('lang_id', $lang, $minutes);
//        return $response;
//
//    }
}
