<?php

namespace ExAdmin\laravel\Console;


use Illuminate\Console\Command;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class PluginComposerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:composer {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the plugin package';

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
        $name = $this->input->getArgument('name');
        $plugs = plugin()->getPlug($name);
        if(!is_array($plugs)){
            $plugs = [$plugs];
        }
        $package = [];
        foreach ($plugs as $plug){
            $requires = $plug['require'] ??[];
            foreach ($requires as $require=>$version){
                $package[] = $require;
                $package[] = $version;
            }
        }
        if(count($package) == 0){
            $this->output->write('Nothing to install, update or remove');
            return 0;
        }
        $path  = dirname(__DIR__,5);
        $cmd = array_merge(['composer','require'],$package);
        $process = new Process($cmd,$path);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });
        return 0;
    }
}
