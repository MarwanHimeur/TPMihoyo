<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

/**
 * Route pour l'édition d'un personnage
 */
class RouteEditPerso extends Route
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
     * Gestion de la requête GET - Redirige vers add-perso avec l'ID
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        // Récupérer l'ID du personnage
        $id = $this->getParam($params, 'id', false);
        
        // Rediriger vers le formulaire d'ajout avec l'ID (pour pré-remplir)
        $this->controller->displayAddPerso($id);
    }

    /**
     * Gestion de la requête POST - Traite la modification du personnage
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        // Pour le moment, vide - sera implémenté dans le prochain TP
        $this->get($params);
    }
}
