<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function configLocation()
    {
        $locations = Location::orderBy('top', 'asc')->whereNotNull('top')->get();
        $locationsView = Location::whereNull('top')->get();
        return view('cms.Config.config-location', [
            'locations' => $locations,
            'locationsView' => $locationsView,
            'count' => count($locations)-1,
        ]);
    }
    
    /**
     * configLocationUp
     *
     * @param  mixed $request
     * @return void
     */
    public function configLocationUp(Request $request)
    {
        $location = Location::find($request->id);
        $previos = Location::where('top', '<', $location->top)->whereNotNull('top')->orderBy('top','desc')->first();
        $previos->increment('top');
        $location->decrement('top');
        return response()->json(array('success' => 'Thành công'));
    }
    /**
     * configLocationUp
     *
     * @param  mixed $request
     * @return void
     */
    public function configLocationDown(Request $request)
    {
        $location = Location::find($request->id);
        $next = Location::where('top', '>', $location->top)->whereNotNull('top')->orderBy('top','asc')->first();
        $location->increment('top');
        $next->decrement('top');
        return response()->json(array('success' => 'Thành công'));
    }
    
    /**
     * thêm địa điểm top
     *
     * @param  mixed $request
     * @return void
     */
    public function add(Request $request)
    {
        $location = Location::find($request->location_id);
        $count = Location::whereNotNull('top')->count();
        if($count == 5)  return response()->json(array('error' => 'Địa điểm top đã đạt tối đa'));
        $location->update(['top' => $count + 1]);
        return response()->json(array('success' => 'Thêm địa điểm top thành công'));
    }
    
    /**
     * configLocationDelete
     *
     * @param  mixed $request
     * @return void
     */
    public function configLocationDelete(Request $request)
    {
        $location = Location::find($request->id);
        $next = Location::where('top', '>', $location->top)->whereNotNull('top')->whereNull('deleted_at')->orderBy('top','asc')->get();
        foreach ($next as $key => $value) {
        
            $value->decrement('top');
        }
        $location->update(['top' => null]);
        return response()->json(array('success' => 'Xóa địa điểm top thành công'));
    }
}
