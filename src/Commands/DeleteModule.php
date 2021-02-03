<?php

namespace Flipper\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Flipper\Module\PackageServiceProvider as Module;

class DeleteModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:delete
        {module : The name of the module}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the specified module.';

    protected $module, $modulePath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function removeModuleFromComposer()
    {
        exec('cd ' . base_path() . ' && composer remove ' . Module::PREFIX_MODULE_NAME . '/' . $this->module);
    }

    protected function deleteModule()
    {
        if (File::exists($this->modulePath)) {
            File::deleteDirectory($this->modulePath);
            $this->removeModuleFromComposer();

            return $this->info('Module deleted successfully!');
        }

        return $this->error('Module does not exists!');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->module = $this->argument('module');
       
        if ($this->confirm('Do you want to delete?')) {
            $this->modulePath = module_path($this->module);
            
            $this->deleteModule();
        }
    }
}
