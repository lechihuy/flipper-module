<?php

namespace Flipper\Module\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Flipper\Module\Support\Stub;
use Flipper\Module\PackageServiceProvider as Module;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:create
        {module : The name of the module}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module.';

    protected $module, $namespace, $summary, $type, $modulePath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function createModulesFolderIfNotExists()
    {
        $modulesPath = base_path('modules');

        if (! File::exists($modulesPath)) {
            File::makeDirectory($modulesPath);
        }
    }

    protected function copyModuleStructure()
    {
        File::makeDirectory($this->modulePath);
        File::copyDirectory(
            __DIR__."/../../resources/structures/$this->type-module/", 
            $this->modulePath
        );
        
        Stub::convert("$this->modulePath/composer.stub", [
            'name' => Module::PREFIX_MODULE_NAME.'/'.$this->module,
            'namespace' => addslashes($this->namespace),
            'description' => $this->summary
        ], 'json');

        Stub::convert("$this->modulePath/src/Providers/RouteServiceProvider.stub", [
            'namespace' => $this->namespace,
            'addslashes_namespace' => addslashes($this->namespace)
        ], 'php');

        Stub::convert("$this->modulePath/src/Providers/ModuleServiceProvider.stub", [
            'namespace' => $this->namespace
        ], 'php');
    }

    protected function requireModuleFromComposer()
    {
        exec('cd ' . base_path() . ' && composer require ' . Module::PREFIX_MODULE_NAME . '/' . $this->module);
    }

    protected function createModule()
    {
        $this->createModulesFolderIfNotExists();

        if (! File::exists($this->modulePath)) {
            $this->copyModuleStructure();
            $this->requireModuleFromComposer();

            return $this->info('Module created successfully!');
        }

        return $this->error('Module already exists!');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->module = $this->argument('module');
        $defaultNamespace = "Modules\\".ucfirst($this->module);

        $this->namespace = $this->ask("Namespace of module [$defaultNamespace]") ?? $defaultNamespace;
        $this->summary = $this->ask("Description of module");
        $this->type = $this->choice('Type of module', ['api', 'web'], 1);
        $this->modulePath = module_path($this->module);
        
        $this->createModule();
    }
}
