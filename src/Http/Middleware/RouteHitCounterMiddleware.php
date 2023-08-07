<?php

namespace Riseuplabs\UrlHitCounter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RouteHitCounterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
        if (config('route_hit_counter.enable')) {

            $date = Carbon::today()->format('Y-m-d');
            $dir = storage_path('route_hit_log');

            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0777, true, true);
            }

            $fileName = 'route_hit_counter' . '_' . $date . '.json';
            $path = $dir . '/' . $fileName;

            if (!File::exists($path)) {
                $jsonContent = json_encode([], JSON_PRETTY_PRINT);
                File::put($path, $jsonContent);
            }



            $prevContentJson = File::get($path);
            $prevContent = json_decode($prevContentJson, true);

            $uri = $request->route()->uri();
            $prevCount = $prevContent[$date][$uri]['count'] ?? 0;
            $prevContent[$date][$uri]['count'] = $prevCount + 1;
            $prevContent[$date][$uri]['request_type'] = $request->method();

            $now = Carbon::now()->format('h:i:s A');
            if ($prevCount == 0) {
                $prevContent[$date][$uri]['created_at'] = $now;
            }
            $prevContent[$date][$uri]['updated_at'] = $now;

            File::put($path, json_encode($prevContent));
        }
        return $next($request);
    }

    
}
