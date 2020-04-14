<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces(array(
    'App\Core' => __DIR__ . '/../apps/Core/',
    'App\Frontend' => __DIR__ . '/../apps/Frontend/',
    'App\Api' => __DIR__ . '/../apps/Api/',
    'App\Backoffice' => __DIR__ . '/../apps/Backoffice/',
));

$loader->register();

?>