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
        try {
            $id = $this->getParam($params, 'id', false);
            $this->controller->displayEditPerso($id);
        } catch (Exception $e) {
            $this->controller->displayAddPerso("ID non trouvé");
        }
    }

    /**
     * Gestion de la requête POST - Traite la modification du personnage
     * @param array $params Paramètres POST
     */
    public function post(array $params = []): void
    {
        try {
            $data = [
                'id' => $this->getParam($params, 'id', false),
                'name' => $this->getParam($params, 'name', false),
                'element' => intval($this->getParam($params, 'element', false)),
                'unitclass' => intval($this->getParam($params, 'unitclass', false)),
                'origin' => $this->getParam($params, 'origin', true) ? intval($this->getParam($params, 'origin')) : null,
                'rarity' => (int)$this->getParam($params, 'rarity', false),
                'urlImg' => $this->getParam($params, 'urlImg', false)
            ];

            $this->controller->editPersoAndIndex($data);

        } catch (Exception $e) {
            if (isset($params['id'])) {
                $this->controller->displayEditPerso($params['id'], $e->getMessage());
            } else {
                $this->controller->displayAddPerso($e->getMessage());
            }
        }
    }
}
