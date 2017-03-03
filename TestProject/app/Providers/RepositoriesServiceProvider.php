<?php namespace App\Providers;

use App\Products\ElasticsearchArticlesRepository;
use App\Products\ProductsRepository;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register()
    {
		
        $this->app->singleton(ProductsRepository::class, function($app)
        {
            return new ElasticsearchArticlesRepository(
                new Client
            );
        });
    }
}