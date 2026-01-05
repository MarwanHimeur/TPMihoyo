<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\MainController;

/**
 * Route pour la page de connexion
 */
class RouteLogin extends Route
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
     * Gestion de la requête GET - Affiche le formulaire de connexion
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        $this->controller->displayLogin();
    }

    /**
     * Gestion de la requête POST - Traite la connexion
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        // Pour le moment, vide - sera implémenté plus tard
        $this->get($params);
    }
}
