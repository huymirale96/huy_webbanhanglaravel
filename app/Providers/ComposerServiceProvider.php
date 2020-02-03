<?php

namespace App\Providers;

use App\Http\ViewComposers\AddressComposers;
use App\Http\ViewComposers\CategoryComposers;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['website.layout.header', 'website.layout.footer'], CategoryComposers::class);
        view()->composer('website.cart.cart', AddressComposers::class);
    }
}
