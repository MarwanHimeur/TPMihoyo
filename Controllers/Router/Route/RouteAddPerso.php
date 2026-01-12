<?php

namespace Controllers\Router\Route;

use Controllers\Router\Route;
use Controllers\PersoController;

/**
 * Route pour l'ajout d'un personnage
 */
class RouteAddPerso extends Route
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
     * Gestion de la requête GET - Affiche le formulaire d'ajout
     * @param array $params Paramètres GET
     */
    public function get(array $params = []): void
    {
        $this->controller->displayAddPerso();
    }

    /**
     * Gestion de la requête POST - Traite l'ajout du personnage
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
       try {
            $data = [
                'name' => $this->getParam($params, 'name', false),
                'element' => intval($this->getParam($params, 'element', false)),
                'unitclass' => intval($this->getParam($params, 'unitclass', false)),
                'origin' => $this->getParam($params, 'origin', true) ? intval($this->getParam($params, 'origin')) : null,
                'rarity' => (int)$this->getParam($params, 'rarity', false),
                'urlImg' => $this->getParam($params, 'urlImg', false)
            ];

            $this->controller->addPerso($data);

        } catch (Exception $e) {
            $this->controller->displayAddPerso($e->getMessage());
        }
    }
}
