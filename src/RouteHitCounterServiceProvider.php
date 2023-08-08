<?php
namespace Riseuplabs\RouteHitCounter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Riseuplabs\RouteHitCounter\Http\Middleware\RouteHitCounterMiddleware;

class RouteHitCounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->publishes([
            __DIR__ . '/config/route_hit_counter.php' => config_path('route_hit_counter.php'),
        ], 'route-hit-counter');

        $middlewares = config('route_hit_counter.middleware', []);

        foreach ($middlewares as $middleware) {
            Route::pushMiddlewareToGroup($middleware, RouteHitCounterMiddleware::class);
        }
    }
}