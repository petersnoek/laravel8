<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::include('inc.formfield', 'field');
        Blade::include('inc.header', 'header');
        Blade::include('inc.headerwithimage', 'headerimg');
        Blade::include('inc.field-hor', 'fieldh');
        Blade::include('inc.field-above', 'fieldabove');
        Blade::include('inc.sidebar-menuitem', 'sbmenuitem');
    }
}
