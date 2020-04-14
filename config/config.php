<?php

return new \Phalcon\Config(array(
    'application' => array(
    'name' => 'Learning Phalcon'
    ),
    'root_dir' => __DIR__.'/../',
    'view' => array(
        'cache' => array(
            'dir' => __DIR__.'/../cache/volt/'
            )
    ),

    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'learning_phalcon',
        'password' => 'password123!',
        'dbname' => 'learning_phalcon',
    ),
));