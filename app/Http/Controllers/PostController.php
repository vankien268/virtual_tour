<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function show(Request $request,$slug){
        $lang_id_session = $request->session()->get('currentLanguage');
        #id ngôn ngữ theo cookie hoặc session
        $language = Language::findByCode($lang_id_session);

        $urlPrev = url()->previous();
        $checkNews = Str::contains($urlPrev,'/news/');
        if($checkNews){
            $slug= Str::after($urlPrev, '/news/');
            $slug = Str::beforeLast($slug,'?');
            $postOld = News::where('slug',$slug)->first();
            $post = News::where('language_id',$language->id)->where('location_id',$postOld->location_id)->first();
        }else{
            $post = News::where('language_id',$language->id)->where('slug',$slug)->first();
        }

        return view('pages.detail-blog')->with([
            'post'=>$post
        ]);
    }

    public function index(Request $request){
        $lang_id_session = $request->session()->get('currentLanguage');
        #id ngôn ngữ theo cookie hoặc session
        $language = Language::findByCode($lang_id_session);
        $posts = News::where('language_id',$language->id)->paginate(8);
        return view('pages.posts')->with([
            'posts'=>$posts
        ]);
    }
}
