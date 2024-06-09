<?php

namespace Aweram\Metable;

use Aweram\Metable\Livewire\MetaIndexWire;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class MetableServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Подключение views.
        $this->loadViewsFrom(__DIR__ . "/resources/views", "ma");

        // Livewire
        $component = config("metable.customMetaIndexComponent");
        Livewire::component(
            "ma-metas",
            $component ?? MetaIndexWire::class
        );
    }

    public function register(): void
    {
        // Миграции
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");

        // Подключение конфигурации
        $this->mergeConfigFrom(
            __DIR__ . "/config/metable.php", "metable"
        );

        // Подключение переводов
        $this->loadJsonTranslationsFrom(__DIR__ . "/lang");
    }
}
