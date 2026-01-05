<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

/**
 * Route pour la suppression d'un personnage
 */
class RouteDelPerso extends Route
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
     * Gestion de la requête GET - Supprime et redirige vers l'index
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        // Récupérer l'ID du personnage
        $id = $this->getParam($params, 'id', false);
        
        // Pour le moment, juste rediriger vers l'index avec un message
        // La vraie suppression sera implémentée dans le prochain TP
        $this->controller->deletePerso($id);
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
