<?php

namespace ProxyMakers\API;

use Illuminate\Support\ServiceProvider;

class ProxyMakersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/proxymakers.php' => config_path('proxymakers.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/proxymakers.php', 'proxymakers'
        );
        $this->app->bind('ProxyMakers\API\ProxyMakers', function () {
            return new ProxyMakers(config('proxymakers.token'));
        });
    }
}
