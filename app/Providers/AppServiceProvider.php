<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('components.navbar', function ($view) {
            if (Auth::check()) {
                $notifications = Notification::where('user_id', auth()->id())
                                             ->orderBy('created_at', 'desc')
                                             ->get();
                $view->with('notifications', $notifications);
            }
        });
    }
}
