<?php

namespace ExAdmin\laravel\Console;

use Database\Seeders\AdminSeeder;
use Illuminate\Console\Command;


class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install {--force : force install}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $this->call('vendor:publish', [
            '--force' => $this->option('force'),
            '--tag' => [
                'ex-admin-ui',
            ]
        ]);
        $path = plugin()->download('laravel');
        if ($path === false) {
            $this->output->warning('下载插件失败');
            return 0;
        }
        $result = plugin()->install($path);
        if ($result !== true) {
            $this->output->warning($result);
            return 0;
        }
        unlink($path);
        plugin()->buildIde();
        plugin()->laravel->install();
        $this->output->success('install success');
        return 0;
    }
}
