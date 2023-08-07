<?php

namespace Riseuplabs\UrlHitCounter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class RouteHitCounterController extends Controller{
    
    public function index(){

        $date = Carbon::today()->format('Y-m-d');
        $todayFileName = 'route_hit_counter'.'_'.$date.'.json';
        $filePath = storage_path('route_hit_log/'.$todayFileName);
           
        if (File::exists($filePath)) {
            return response()->json(json_decode(file_get_contents($filePath)), 200);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}