<?php

namespace App\Providers;

use App\Http\Wechat;
use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Http\Wechat',function(){
           $arr = config('wechat.app') ;
            return new Wechat($arr);
        });
    }
}
