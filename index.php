<?php
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new Helpers\Psr4AutoloaderClass();

$loader->register();

$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('Controllers',__DIR__ . '/Controllers');
$loader->addNamespace('Models',__DIR__ . '/Models');
$loader->addNamespace('Services', __DIR__ .'/Services');
$loader->addNamespace('League\Plates', 'Vendor/Plates/src');

use Controllers\MainController;

$controller = new MainController();
$controller->index();