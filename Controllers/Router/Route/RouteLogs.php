<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page des logs
 */
class RouteLogs extends Route
{
    private MainController $controller;

    /**
     * Constructeur
     * @param MainController $controller Le contrôleur principal
     */
    public function __construct(MainController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Gestion de la requête GET - Affiche les logs
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        $this->controller->displayLogs();
    }

    /**
     * Gestion de la requête POST
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        $this->get($params);
    }
}
