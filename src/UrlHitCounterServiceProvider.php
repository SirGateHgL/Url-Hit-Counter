<?php
namespace Riseuplabs\UrlHitCounter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Riseuplabs\UrlHitCounter\Http\Middleware\RouteHitCounterMiddleware;


class UrlHitCounterServiceProvider extends ServiceProvider{

    public function register()
    {
        
    }

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php'); 

        /*RouteHitCounterMiddleware register inside web & api 
          midlleware group to access all request to get service
        */


        $this->publishes([
            __DIR__ . '/config/route_hit_counter.php' => config_path('route_hit_counter.php'),
        ], 'config-publish');


        $middlewares = config('route_hit_counter.middleware');
        foreach($middlewares??[] as $middleware){
            Route::pushMiddlewareToGroup( $middleware, RouteHitCounterMiddleware::class);
        }
    }
}