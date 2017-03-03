<?php

namespace App\Providers;

use App\Observers\ElasticsearchProductObserver;
use App\ProductMaster;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        ProductMaster::observe($this->app->make(ElasticsearchProductObserver::class));
    }

    public function register()
    {
        $this->app->singleton(ElasticsearchProductObserver::class, function()
        {
            return new ElasticsearchProductObserver(ClientBuilder::create()->build());
        });
    }
}