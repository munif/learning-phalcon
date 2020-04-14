<?php
$di['router'] = function () use ($default_module, $modules, $di, $config) {

    $router = new \Phalcon\Mvc\Router(false);
    $router->clear();
    
    // Default routing
    $router->add('/', array(
        'module' => $default_module,
        'controller' => 'index',
        'action' => 'index'
    ));

    // Untuk controller tertentu di dalam default module (frontend)
    $router->add('/:controller/:params', array(
        'module' => $default_module,
        'controller' => 1, // Artinya parameter pertama (/:controller)
        'action' => 'index', // Default action diarahkan ke index
        'params' => 2, // artinya parameter kedua (/:params)
    ));

    // Untuk controller dan action tertentu di dalam default module (frontend)
    $router->add('/:controller/:action/:params', array(
        'module' => $default_module,
        'controller' => 1,
        'action' => 2,
        'params' => 3
    ));


    // Untuk routing module-module yang lain
    foreach ($modules as $moduleName => $module) {
        
        // Jika nama module adalah frontend, maka tidak perlu ditambahkan
        if($moduleName == $default_module)
            continue;

        // Untuk index masing-masing module, contoh: /backoffice/, /api/, /core/
        $router->add('/'. $moduleName .'/:params', array(
            'module' => $moduleName,
            'controller' => 'index', // Default controller diarahkan ke IndexController
            'action' => 'index',  // Default action diarahkan ke index di dalam IndexController
            'params' => 1
        ));

        // Untuk controller tertentu di dalam module
        $router->add('/'. $moduleName .'/:controller/:params', array(
            'module' => $moduleName,
            'controller' => 1, // Artinya parameter pertama (/:controller)
            'action' => 'index', // Default action diarahkan ke index
            'params' => 2, // artinya parameter kedua (/:params)
        ));

        // Untuk controller dan action tertentu di dalam module
        $router->add('/'. $moduleName .'/:controller/:action/:params', array(
            'module' => $moduleName,
            'controller' => 1,
            'action' => 2,
            'params' => 3
        ));
    }

    // var_dump($router);

    return $router;
};
