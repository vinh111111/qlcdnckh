<?php

namespace App\Providers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Typeproject;
use App\Models\User;

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
        View::composer(['layout.header','layout.footer'], function ($view) {
            $typeproject = Typeproject::all();
            $view->with('typeproject', $typeproject);
        });
        View::composer(['profile.layout.header','posts.layout.header','approval.layout.header','admin.approve.layout.header','admin.categories.layout.header','admin.posts.layout.header','admin.profile.layout.header','admin.users.layout.header','admin.approve-view.layout.header',], function ($view) {
            $user = Auth::user();
            $id_user =$user->id;
            $notifications = Notification::where('id_user',$id_user)->get();
            $view->with('notifications', $notifications);
        });
    }
}
