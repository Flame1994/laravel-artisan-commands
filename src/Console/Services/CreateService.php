<?php

namespace Rhaarhoff\LaravelArtisanCommands\Console\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use InvalidArgumentException;

class CreateService extends GeneratorCommand
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
        if ($this->option('constructor') && !$this->option('repository')) {
            return __DIR__.'/stubs/service.constructor.stub';
        } elseif($this->option('repository')) {
            return __DIR__.'/stubs/service.repo.stub';
        }

        return __DIR__.'/stubs/service.plain.stub';
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

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param string $name
     * @return mixed|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $serviceNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('repository')) {
            $replace = $this->buildRepoReplacements($replace);
        }

        if ($this->option('model') && !$this->option('repository')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace["use ${serviceNamespace}\Service;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildRepoReplacements(array $replace)
    {
        $repoClass = $this->parseRepo($this->option('repository'));

        if (! class_exists($repoClass)) {
            if ($this->option('model')) {
                Log::info('Selected Model: ' . $this->option('model'));
                $this->call('make:repository', ['name' => $repoClass, '-m' => $this->option('model')]);
            } else {
                $this->call('make:repository', ['name' => $repoClass]);
            }
        } else {
            $this->info('Repository already exists. Linking service to ' . class_basename($repoClass) . ' repository.');
        }

        return array_merge($replace, [
            'DummyFullRepositoryClass' => $repoClass,
            'DummyRepositoryClass' => class_basename($repoClass),
            'DummyRepositoryVariable' => lcfirst(class_basename($repoClass)),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $repo
     * @return string
     */
    protected function parseRepo($repo)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $repo)) {
            throw new InvalidArgumentException('Repository name contains invalid characters.');
        }

        $repo = trim(str_replace('/', '\\', $repo), '\\');

        $rootNamespace = $this->laravel->getNamespace();
        if (! Str::startsWith($repo, $rootNamespace.'Http\Repositories\\')) {
            $repo = $rootNamespace.'Http\Repositories\\'.$repo;
        }

        return $repo;
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            $this->call('make:model', ['name' => $modelClass]);
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariable' => lcfirst(class_basename($modelClass)),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (! Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace())) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['repository', 'y', InputOption::VALUE_REQUIRED, 'Generate a repository for the given service.'],

            ['constructor', 'c', InputOption::VALUE_NONE, 'Generate a constructor for the given service.'],

            ['model', 'm', InputOption::VALUE_REQUIRED, 'Generate a model for the given repository & service.']
        ];
    }

}
