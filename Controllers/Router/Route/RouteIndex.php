<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page d'accueil
 */
class RouteIndex extends Route
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
     * Gestion de la requête GET
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        // Récupérer le message s'il existe
        $message = $params['message'] ?? null;
        
        $this->controller->index($message);
    }

    /**
     * Gestion de la requête POST
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        // Pour l'index, POST fait la même chose que GET
        $this->get($params);
    }
}
