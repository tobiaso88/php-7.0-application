<?php

namespace App;

class Application
{
    protected $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }
}
