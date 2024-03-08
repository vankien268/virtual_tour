<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CMS\ConfigController;
use App\Http\Controllers\CMS\LanguageController;
use App\Http\Controllers\CMS\LocationController;
use App\Http\Controllers\CMS\NewController;
use App\Http\Controllers\CMS\PermissionController;
use App\Http\Controllers\CMS\PresentationController;
use App\Http\Controllers\CMS\RelatedLocationController;
use App\Http\Controllers\CMS\RoleController;
use App\Http\Controllers\CMS\UserSpatieController;
use App\Http\Controllers\CMS\ZoneController;
use App\Http\Controllers\CMS\SettingController;
use App\Jobs\ScanJob;
use App\Models\News;
use App\Models\Presentation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/locations/{id}', 'PresentationController@index')->name('locations');
Route::get('/news/{slug}', 'PostController@show')->name('post');
Route::get('/news', 'PostController@index')->name('posts');
Route::post('/setcookie', 'LangController@setCookie')->name('setCookie');
Route::get('/remove',function (){
    Session::forget('currentLanguage');
});







//cms
Route::group(['prefix' => 'admin', 'as' => 'cms.'], function () {

    //auth
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);


    Route::group(['middleware' => 'auth'], function(){

        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/', function () {
            return view('cms.index');
        })->name('index');
        //crud vùng
        Route::prefix('zones')->group(function () {
            Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
            Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
            Route::post('/store', [ZoneController::class, 'store'])->name('zones.store');
            Route::get('/edit/{id}', [ZoneController::class, 'edit'])->name('zones.edit');
            Route::post('/update', [ZoneController::class, 'update'])->name('zones.update');
            Route::post('/destroy', [ZoneController::class, 'destroy'])->name('zones.destroy');
        });
        //crud ngôn ngữ
        Route::prefix('languages')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('languages.index');
            Route::get('/create', [LanguageController::class, 'create'])->name('languages.create');
            Route::get('/default', [LanguageController::class, 'default'])->name('languages.default');
            Route::post('/store', [LanguageController::class, 'store'])->name('languages.store');
            Route::get('/edit/{id}', [LanguageController::class, 'edit'])->name('languages.edit');
            Route::post('/update', [LanguageController::class, 'update'])->name('languages.update');
            Route::post('/destroy', [LanguageController::class, 'destroy'])->name('languages.destroy');
        });
        //crud địa điểm
        Route::prefix('locations')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('locations.index');
            Route::get('/create', [LocationController::class, 'create'])->name('locations.create');
            Route::post('/store', [LocationController::class, 'store'])->name('locations.store');
            Route::get('/edit/{id}', [LocationController::class, 'edit'])->name('locations.edit');
            Route::post('/update', [LocationController::class, 'update'])->name('locations.update');
            Route::post('/destroy', [LocationController::class, 'destroy'])->name('locations.destroy');
            Route::get('/render', [LocationController::class, 'renderTable'])->name('locations.render.table');
            Route::get('/modal/qr', [LocationController::class, 'renderModalQr'])->name('locations.modal.qr');
            Route::get('/download', [LocationController::class, 'downloadQrcode'])->name('locations.download');
        });
        //crud địa điểm liên quan
        Route::prefix('related-locations')->group(function () {
            Route::get('/', [RelatedLocationController::class, 'index'])->name('related.locations.index');
            Route::get('/create', [RelatedLocationController::class, 'create'])->name('related.locations.create');
            Route::post('/store', [RelatedLocationController::class, 'store'])->name('related.locations.store');
            Route::get('/edit/{id}', [RelatedLocationController::class, 'edit'])->name('related.locations.edit');
            Route::post('/update', [RelatedLocationController::class, 'update'])->name('related.locations.update');
            Route::post('/destroy', [RelatedLocationController::class, 'destroy'])->name('related.locations.destroy');
        });
        //crud thuyết minh
        Route::prefix('locations/presentations')->group(function () {
            Route::get('/', [PresentationController::class, 'index'])->name('presentations.index');
            Route::get('/create', [PresentationController::class, 'create'])->name('presentations.create');
            Route::post('/store', [PresentationController::class, 'store'])->name('presentations.store');
            Route::get('/edit/{id}', [PresentationController::class, 'edit'])->name('presentations.edit');
            Route::post('/update', [PresentationController::class, 'update'])->name('presentations.update');
            Route::get('/destroy', [PresentationController::class, 'destroy'])->name('presentations.destroy');
        });
        //crud tin tức
        Route::prefix('news')->group(function () {
            Route::get('/', [NewController::class, 'index'])->name('news.index');
            Route::get('/create', [NewController::class, 'create'])->name('news.create');
            Route::post('/store', [NewController::class, 'store'])->name('news.store');
            Route::get('/edit/{id}', [NewController::class, 'edit'])->name('news.edit');
            Route::post('/update', [NewController::class, 'update'])->name('news.update');
            Route::post('/destroy', [NewController::class, 'destroy'])->name('news.destroy');
        });
        //crud setting
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('settings.index');
            Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
            Route::post('/store', [SettingController::class, 'store'])->name('settings.store');
            Route::get('/edit/{id}', [SettingController::class, 'edit'])->name('settings.edit');
            Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
            Route::post('/destroy', [SettingController::class, 'destroy'])->name('settings.destroy');
        });
        //config
        Route::prefix('config')->group(function () {
            Route::get('/locations', [ConfigController::class, 'configLocation'])->name('config.locations');
            Route::post('/locations/add', [ConfigController::class, 'add'])->name('config.locations.add');
            Route::get('/locations/up', [ConfigController::class, 'configLocationUp'])->name('config.locations.up');
            Route::get('/locations/down', [ConfigController::class, 'configLocationDown'])->name('config.locations.down');
            Route::get('/locations/delete', [ConfigController::class, 'configLocationDelete'])->name('config.locations.delete');
        });

        //crud phân quyền
        Route::group(['prefix' => 'manager', 'as' => 'manager.'], function () {
            //user
            Route::prefix('users')->group(function () {
                Route::get('/', [UserSpatieController::class, 'index'])->name('users.index');
                Route::get('/create', [UserSpatieController::class, 'create'])->name('users.create');
                Route::post('/store', [UserSpatieController::class, 'store'])->name('users.store');
                Route::get('/edit/{id}', [UserSpatieController::class, 'edit'])->name('users.edit');
                Route::post('/update', [UserSpatieController::class, 'update'])->name('users.update');
                Route::post('/destroy', [UserSpatieController::class, 'destroy'])->name('users.destroy');
                Route::get('/role-permission/{id}', [UserSpatieController::class, 'rolePermission'])->name('users.role.permission');
                Route::post('/role-permission', [UserSpatieController::class, 'rolePermissionStore'])->name('users.role.permission.store');
                Route::post('/change-password', [UserSpatieController::class, 'changePassword'])->name('users.change.password');
                Route::get('/render-per', [UserSpatieController::class, 'renderPermission'])->name('users.render.permission');
            });
            //role
            Route::prefix('roles')->group(function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles.index');
                Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
                Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
                Route::post('/update', [RoleController::class, 'update'])->name('roles.update');
                Route::post('/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');
                Route::get('/permission/{id}', [RoleController::class, 'rolePermission'])->name('roles.permission');
                Route::post('/permission', [RoleController::class, 'rolePermissionStore'])->name('roles.permission.store');
            });
            //permission
            Route::prefix('permissions')->group(function () {
                Route::get('/', [PermissionController::class, 'index'])->name('permissions.index');
                Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
                Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
                Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
                Route::post('/update', [PermissionController::class, 'update'])->name('permissions.update');
                Route::post('/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');
            });
        });
    });
});


Route::get('/test', function (Request $request) {
    // dd($request->all());
    // DB::table('users')->update(['password' => Hash::make('Newway@2023')]);
    // $news = News::all();
    // foreach ($news as $key => $new) {
    //     $new->update(['position' => $key+1]);
    // }
    // $presetations = Presentation::all();
    // foreach ($presetations as $key => $presetation) {
    //     $presetation->update(['position' => $key+1]);
    // }

    // dd($request->all());
    // $presetation = Presentation::find(1);
    // Scanjob::dispatch();
    // dispatch(new ScanJob($presetation, $request->ip(), $request->header('User-Agent')))->delay(Carbon::now()->addSecond(10));
    // dd($request->ip());
    // dd($request->header('User-Agent'));
})->name('test');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
