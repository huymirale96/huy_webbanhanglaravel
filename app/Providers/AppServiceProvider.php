<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Province;
use App\Models\Ward;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\NewDetail;

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
    }
}
