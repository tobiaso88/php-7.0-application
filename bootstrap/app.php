<?php

ini_set('display_errors', 1);

$app = new App\Application(realpath(__DIR__ . '/../'));
$app->instance('env', new Dotenv\Repository\Adapter\EnvConstAdapter());

$repository = Dotenv\Repository\RepositoryBuilder::create()
    ->withReaders([
        app('env'),
    ])
    ->withWriters([
        app('env'),
        new Dotenv\Repository\Adapter\PutenvAdapter(),
    ])
    ->immutable()
    ->make();

$dotenv = Dotenv\Dotenv::create($repository, $app->basePath());
$dotenv->load();

return $app;
