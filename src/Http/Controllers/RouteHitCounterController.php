<?php

namespace Riseuplabs\RouteHitCounter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class RouteHitCounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function index()
    {
        $todayFileName = sprintf('route_hit_counter_%s.json', date('Y-m-d'));
        $filePath = sprintf('%s/%s', storage_path('route_hit_log'), $todayFileName);
        
        if (File::exists($filePath)) {
            $contents = json_decode(file_get_contents($filePath));
            return view("view::index", compact('contents'));
            // return response()->json($contents);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}