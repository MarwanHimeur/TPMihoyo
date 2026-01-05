<?php
// Activer l'affichage des erreurs pour le développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chargement de l'autoloader PSR-4
require_once __DIR__ . '/Helpers/Psr4AutoloaderClass.php';

$loader = new Helpers\Psr4AutoloaderClass();
$loader->register();

// Enregistrement de tous les namespaces
$loader->addNamespace('Helpers', 'Helpers');
$loader->addNamespace('Config', 'Config');
$loader->addNamespace('Controllers', 'Controllers');
$loader->addNamespace('Controllers\Router', 'Controllers/Router');
$loader->addNamespace('Controllers\Router\Route', 'Controllers/Router/Route');
$loader->addNamespace('Models', 'Models');
$loader->addNamespace('Services', 'Services');
$loader->addNamespace('League\Plates', 'Vendor/Plates/src');

// Instanciation du routeur et routing
use Controllers\Router\Router;

$router = new Router();
$router->routing($_GET, $_POST);