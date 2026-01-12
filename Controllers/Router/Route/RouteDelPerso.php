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
        try {
            // Récupérer l'ID du personnage
            $id = $this->getParam($params, 'id', false);
            
            // Supprimer le personnage
            $this->controller->deletePersoAndIndex($id);
            
        } catch (Exception $e) {
            // En cas d'erreur (ID manquant), appeler sans paramètre
            $this->controller->deletePersoAndIndex();
        }
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
