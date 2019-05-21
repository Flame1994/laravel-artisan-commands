<?php
namespace rhaarhoff\fouricommands\Console\Services;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
class Create extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:service';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $type = 'Service';

    public function getStub() {
        $stub = '/stubs/service.plain.stub';

        return __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Services';
    }

}