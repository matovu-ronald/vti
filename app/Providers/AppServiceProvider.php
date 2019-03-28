<?php

namespace App\Providers;

use App\Models\Vti;
use App\Observers\VtiObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->overrideConfigValues();

        // Register vti observer
        // Vti::observe(VtiObserver::class);
    }

    protected function overrideConfigValues()
    {
        $config = [];
        if (config('settings.skin')) {
            $config['backpack.base.skin'] = config('settings.skin');
        }
        if (config('settings.show_powered_by')) {
            $config['backpack.base.show_powered_by'] = config('settings.show_powered_by') == '1';
        }
        config($config);
    }


}
