<?php

namespace App\Providers;

use App\Models\back\Ad;
use App\Models\back\AdvertisingCategory;
use App\Models\back\Blog;
use App\Models\back\Chat;
use App\Models\back\Comment;
use App\Models\back\Complaint;
use App\Models\back\Role;
use App\Models\back\SeoTag;
use App\Models\back\Suggestion;
use App\Models\back\Ticket;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        Paginator::useBootstrap();

        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            view()->share([]);
        });
    }
}
