<?php

use App\ApiKernel;

$kernel = new ApiKernel(
    $_SERVER['APP_ENV'] ?? 'dev',
    $_SERVER['APP_DEBUG'] ?? ('prod' !== ($_SERVER['APP_ENV'] ?? 'dev'))
);