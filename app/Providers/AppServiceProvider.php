<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event\SendMailToUserEvent;
use App\Events\SendMailToUserEvent as EventsSendMailToUserEvent;
use App\Listeners\SendMailToUserListner;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;


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
        $appname = App::environment('APP_NAME');
        view()->share('appname', $appname);
        JsonResource::withoutWrapping();
    }
}
