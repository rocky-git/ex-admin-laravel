<?php

namespace ExAdmin\laravel;

use App\Admin\Controllers\AdminController;
use ExAdmin\laravel\Console\InstallCommand;
use ExAdmin\laravel\Console\PluginComposerCommand;
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
        $this->updateVersion();
        //依赖注入
        \ExAdmin\ui\Route::setObjectParamAfter(function ($name){
            return $this->app->make($name);
        });
    }
    protected function updateVersion(){
        $file = public_path('exadmin').DIRECTORY_SEPARATOR.'version';
        $update = false;
        if(!is_file($file)){
            $update = true;
        }
        if(!$update && file_get_contents($file) != ex_admin_version()){
            $update = true;
        }
        if($update){
            app(\Illuminate\Contracts\Console\Kernel::class)->call('vendor:publish',['--force'=>true,'--tag'=>['ex-admin-ui']]);
            file_put_contents($file,ex_admin_version());
        }
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        //前端ui
        $this->publishes([__DIR__ . '/../../ex-admin-ui/resources' => public_path('exadmin')], 'ex-admin-ui');
        
        $this->commands([
            InstallCommand::class,
            PluginComposerCommand::class
        ]);
    }
}
