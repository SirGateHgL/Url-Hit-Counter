<?php

namespace Riseuplabs\RouteHitCounter\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if (config('route_hit_counter.enabled')) {
            $today = date('Y-m-d');
            $directory = storage_path('route_hit_log');

            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }

            $fileName = sprintf('route_hit_counter_%s.json', $today);
            $path = $directory . DIRECTORY_SEPARATOR . $fileName;

            if (!File::exists($path)) {
                $jsonContent = json_encode([], JSON_PRETTY_PRINT);
                File::put($path, $jsonContent);
            }

            $prevContentJson = File::get($path);
            $prevContent = json_decode($prevContentJson, true);

            $uri = $request->route()->uri();
            $prevCount = $prevContent[$today][$uri]['count'] ?? 0;
            $prevContent[$today][$uri]['count'] = $prevCount + 1;
            $prevContent[$today][$uri]['request_type'] = $request->method();

            $now = date('h:i:s A');

            if ($prevCount == 0) {
                $prevContent[$today][$uri]['created_at'] = $now;
            }

            $prevContent[$today][$uri]['updated_at'] = $now;

            File::put($path, json_encode($prevContent));
        }

        return $next($request);
    }
}