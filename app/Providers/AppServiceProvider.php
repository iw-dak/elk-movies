<?php

namespace App\Providers;


use Elasticsearch\Client;
use App\Movies\MoviesRepository;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use App\Movies\EloquentMoviesRepository;
use App\Movies\ElasticsearchMoviesRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MoviesRepository::class, function($app) {
        
            if (!config('services.search.enabled')) 
            {
                die('wrond');
                return new EloquentMoviesRepository();
            }

            return new ElasticsearchMoviesRepository(
                $app->make(Client::class)
            );
        });
        $this->bindSearchClient();
    }

    /**
     * Configure elasticsearch client
     *
     * @return void
    */
    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(['elasticsearch'])
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
