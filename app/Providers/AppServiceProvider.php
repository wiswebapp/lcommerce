<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\macro\GeneralMacros;
use App\macro\QueryFunctionMacros;
use Illuminate\Database\Eloquent\Builder;
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
        // Str::macro('searchSystem', function($searchTerm){
        //    echo $searchTerm;
        // });
        Str::mixin(new GeneralMacros);
        Builder::mixin(new QueryFunctionMacros);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        error_reporting(0);
    }
}
