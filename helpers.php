<?php

use Dotenv\Repository\Adapter\EnvConstAdapter;

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        return (new EnvConstAdapter())->get() ?? $default;
    }
}
