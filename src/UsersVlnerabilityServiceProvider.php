<?php

namespace Xlong\UsersVlnerability;

use Illuminate\Support\ServiceProvider;

class UsersVlnerabilityServiceProvider extends ServiceProvider
{
    /**
     * 服务提供者加是否延迟加载.
     * @var bool
     */
    protected $defer = true; // 延迟加载服务

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/user_vlnerability.php' => config_path('user_vlnerability.php'), // 发布配置文件到 laravel 的config 下
            __DIR__.'/migrations/2022_06_13_113608_create_vlnerability_users_log_table.php' => base_path('database/migrations/2022_06_13_113608_create_vlnerability_users_log_table.php'), // 发布配置文件到 laravel 的config 下
            __DIR__.'/migrations/2022_06_13_113625_create_vlnerability_users_token_table.php' => base_path('database/migrations/2022_06_13_113625_create_vlnerability_users_token_table.php'), // 发布配置文件到 laravel 的config 下
            __DIR__.'/Models/VlnerabilityUsersLog.php' => base_path('app/Models/VlnerabilityUsersLog.php'), // 发布日志模型到 laravel 的Models 下
            __DIR__.'/Models/VlnerabilityUsersToken.php' => base_path('app/Models/VlnerabilityUsersToken.php'), // 发布Token模型到 laravel 的Models 下
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 单例绑定服务
        $this->app->singleton('packagetest', function ($app) {
            return new UsersVlnerabilityService($app['session'], $app['config']);
        });
    }


    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        // 因为延迟加载 所以要定义 provides 函数 具体参考laravel 文档
        return ['UsersVlnerabilityServiceProvider'];
    }

}
