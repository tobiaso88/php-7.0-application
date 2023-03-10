<?php

namespace App;

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter\EnvConstAdapter;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;
use Illuminate\Container\Container;

class Application extends Container
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;

        $this->loadEnviroment();
        $this->registerBaseBindings();
    }

    protected function loadEnviroment()
    {
        $repository = RepositoryBuilder::create()
            ->withReaders([
                new EnvConstAdapter(),
            ])
            ->withWriters([
                new EnvConstAdapter(),
                new PutenvAdapter(),
            ])
            ->immutable()
            ->make();

        $dotenv = Dotenv::create($repository, $this->basePath);
        $dotenv->load();

    protected function registerBaseBindings()
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }
    }

    public function terminate()
    {
        echo "Hello " . env('APP_NAME') . "!";
    }
}
