<?php

namespace App\Providers;

use Carbon\Carbon;
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
        // necessary for mysql compatibility
        Schema::defaultStringLength(191);
        // set German locale for php date time and Carbon
        setlocale(LC_TIME, 'de_DE@euro', 'de_DE', 'deu_deu', 'German');
        Carbon::setLocale(config('app.locale'));
        // mock date TODO: remove
        //$mockdate = Carbon::create(2017,11,14);
        //Carbon::setTestNow($mockdate);
    }
}
