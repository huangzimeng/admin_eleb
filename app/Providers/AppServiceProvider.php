<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //设置最大长度
        Schema::defaultStringLength(191);
        /*
         * 定义admin规则  只有已经登录并且登录名为admin 才能看到 权限管理按钮
         * eg:
         *
            @admin
            <li><a href="{{route('permit.index')}}">权限管理</a></li>
            @endadmin
         */
        Blade::if('admin',function (){
            return auth()->check() && auth()->user()->name == 'admin';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
