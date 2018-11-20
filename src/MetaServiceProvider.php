<?php

namespace Skotner\Meta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;


class MetaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/meta.php' => config_path('meta.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/meta.php', 'meta');

        if (! class_exists('CreateMetaTable')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../migrations/create_meta_table.php.stub' => database_path("/migrations/{$timestamp}_create_meta_table.php"),
            ], 'migrations');
        }
    }

    public function register()
    {
        
    }

}
