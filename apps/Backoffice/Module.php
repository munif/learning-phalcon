<?php
namespace App\Backoffice;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Di\DiInterface;

class Module implements ModuleDefinitionInterface
{
    /**
    * Registers the module auto-loader
    */
    public function registerAutoloaders(DiInterface $di =
    null) {}

    /**
    * Registers the module-only services
    *
    * @param Phalcon\DI $di
    */
    public function registerServices(DiInterface $di)
    {
        $config = include __DIR__ . "/Config/config.php";
        $di['config'] = $config;
        include __DIR__ . "/Config/services.php";
    }
}