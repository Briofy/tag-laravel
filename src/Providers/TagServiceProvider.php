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
        $this->loadRoutesFrom(__DIR__.'/../Routes/tags.php');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

            $this->publishes([
                __DIR__.'/../Config/briofy-tag.php' => config_path('briofy-tag.php'),
            ], 'briofy-tag-config');
        }

        $this->app->bind(ITagRepository::class, TagRepository::class);
    }
}
