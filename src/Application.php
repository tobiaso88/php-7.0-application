<?php

namespace App;

use Illuminate\Container\Container;

class Application extends Container
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;

        $this->registerBaseBindings();
    }

    protected function loadEnviroment()
    {
           
    }

    protected function registerBaseBindings()
    {
        static::setInstance($this);
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }

    public function basePath($path = '')
    {
        return $this->basePath . ($path != '' ? DIRECTORY_SEPARATOR . $path : '');
    }

    public function terminate()
    {
        echo "Hello " . env('APP_NAME') . "!";
    }
}
