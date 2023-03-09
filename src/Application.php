<?php

namespace App;

use Dotenv\Dotenv;
use Dotenv\Repository\Adapter\EnvConstAdapter;
use Dotenv\Repository\Adapter\PutenvAdapter;
use Dotenv\Repository\RepositoryBuilder;

class Application
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;

        $this->loadEnviroment();
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
    }

    public function terminate()
    {
        echo "Hello " . env('APP_NAME') . "!";
    }
}
