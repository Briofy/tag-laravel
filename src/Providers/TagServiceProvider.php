<?php

namespace Briofy\Tag\Providers;

use Briofy\Tag\Repositories\ITagRepository;
use Briofy\Tag\Repositories\TagRepository;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../Config/briofy-tag.php', 'briofy-tag');
    }

    public function boot()
    {
        if (config('briofy-tag.routes.api.enabled')) $this->loadRoutesFrom(__DIR__.'/../Routes/api.php');
        if (config('briofy-tag.routes.web.enabled')) $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

            $this->publishes([
                __DIR__.'/../Config/briofy-tag.php' => config_path('briofy-tag.php'),
            ], 'briofy-tag-config');
        }

        $this->app->bind(ITagRepository::class, TagRepository::class);
    }
}
