<?php
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new Helpers\Psr4AutoloaderClass();

$loader->register();

$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Services', 'Services');
$loader->addNamespace('League\Plates', 'Vendor/Plates/src');

use Controllers\MainController;

$controller = new MainController();
$controller->index();