<?php

ini_set('display_errors', 1);

$app = new App\Application(realpath(__DIR__ . '/../'));

return $app;
