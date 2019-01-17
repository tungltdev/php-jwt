<?php

namespace Tungltdev\JWT;

use Illuminate\Support\ServiceProvider;

class JwtAuthTokenProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/jwt.php' => config_path('jwt.php')
        ]);
        copy(__DIR__ . '/config/VerifyJWTToken.php', config_path('../app/Http/Middleware/VerifyJWTToken.php'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/jwt.php', 'jwt'
        );
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('jwt');
    }

}
