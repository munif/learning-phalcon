<?php

declare(strict_types=1);

use App\Core\Managers\ArticleManager;
use App\Core\Managers\CategoryManager;
use App\Core\Managers\UserManager;
use Exception;
use Phalcon\Cli\Console;
use Phalcon\Cli\Dispatcher;
use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Exception as PhalconException;
use Phalcon\Loader;
use Throwable;

$loader = new Loader();
$loader->registerNamespaces(
    [
       'App' => '../apps/',
       'App\Core\Managers' => '../apps/Core/Managers/'
    ]
);
$loader->register();

$container  = new CliDI();
$dispatcher = new Dispatcher();

$dispatcher->setDefaultNamespace('App\Tasks');

$container->setShared('dispatcher', $dispatcher);

$container->setShared('core_user_manager', function() use ($container) {
    $repo = new UserManager();
    return $repo;
});

$container->setShared('core_category_manager', function() use ($container) {
    $repo = new CategoryManager();
    return $repo;
});

$container->setShared('core_article_manager', function() use ($container) {
    $repo = new ArticleManager();
    return $repo;
});


$container['db'] = function () use ($container) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => "localhost",
        "username" => "learning_phalcon",
        "password" => "password123!",
        "dbname" => "learning_phalcon",
    ));
};

$console = new Console($container);

$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k === 1) {
        $arguments['task'] = $arg;
    } elseif ($k === 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}


try {
    $console->handle($arguments);
} catch (PhalconException $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} catch (Throwable $throwable) {
    fwrite(STDERR, $throwable->getMessage() . PHP_EOL);
    exit(1);
} catch (Exception $exception) {
    fwrite(STDERR, $exception->getMessage() . PHP_EOL);
    exit(1);
}