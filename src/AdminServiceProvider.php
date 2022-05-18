<?php

namespace ExAdmin\laravel;

use App\Admin\Controllers\AdminController;
use ExAdmin\laravel\Console\InstallCommand;
use ExAdmin\laravel\Middleware\LoadLangPack;
use ExAdmin\laravel\Middleware\Permission;
use ExAdmin\ui\support\Container;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
   
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Container::getInstance()->plugin->register();
    }
   
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        //前端ui
        $this->publishes([__DIR__ . '/../../ex-admin-ui/resources' => public_path('ex-admin')], 'ex-admin-ui');
        
        $this->commands([
            InstallCommand::class
        ]);
    }
}
