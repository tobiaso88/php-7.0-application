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
        $repository = RepositoryBuilder::createWithNoAdapters()
            ->addAdapter(EnvConstAdapter::class)
            ->addWriter(PutenvAdapter::class)
            ->immutable()
            ->make();

        $dotenv = Dotenv::create($repository, $this->basePath);
        $dotenv->load();
    }

    public function terminate()
    {
        echo "Hello world!";
        var_dump(getenv('APP_NAME'));
    }
}
