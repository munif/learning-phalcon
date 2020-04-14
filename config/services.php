<?php

use \Phalcon\Logger\Adapter\File as Logger;

$di['security'] = function () {
    $security = new \Phalcon\Security();
    $security->setWorkFactor(10);
    return $security;
};

$di['url'] = function () use ($config, $di) {
    $url = new \Phalcon\Url();
    return $url;
};

$di['voltService'] = function ($view) use ($config) {
    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $this);
    if (!is_dir($config->view->cache->dir)) {
        mkdir($config->view->cache->dir);
    }
    $volt->setOptions(array(
        "path" => $config->view->cache->dir,
        "extension" => ".compiled",
        "always" => true
    ));
    return $volt;
};

$di['logger'] = function () {
    $file = __DIR__ . "/../logs/" . date("Y-m-d") . ".log";
    $logger = new Logger($file, array('mode' => 'w+'));
    return $logger;
};

$di['db'] = function () use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname,
    ));
};

$di['core_article_manager'] = function () {
    return new App\Core\Managers\ArticleManager();
};
