<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

/**
 * Route pour l'ajout d'un élément (element, weapon, origin)
 */
class RouteAddElement extends Route
{
    private PersoController $controller;

    /**
     * Constructeur
     * @param PersoController $controller Le contrôleur de personnages
     */
    public function __construct(PersoController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Gestion de la requête GET - Affiche le formulaire d'ajout d'élément
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddElement();
    }

    /**
     * Gestion de la requête POST - Traite l'ajout de l'élément
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        // Pour le moment, vide - sera implémenté plus tard
        $this->get($params);
    }
}
