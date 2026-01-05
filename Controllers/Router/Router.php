<?php

namespace Controllers\Router;

use Controllers\MainController;
use Controllers\PersoController;
use Exception;

/**
 * Classe Router
 * Gère le routage de l'application en fonction des paramètres GET/POST
 */
class Router
{
    /**
     * Liste des routes disponibles
     * @var array<string, Route>
     */
    private array $routeList = [];

    /**
     * Liste des contrôleurs instanciés
     * @var array<string, object>
     */
    private array $ctrlList = [];

    /**
     * Nom de la clé d'action dans l'URL
     * @var string
     */
    private string $action_key;

    /**
     * Constructeur du routeur
     * @param string $name_of_action_key Nom du paramètre d'action (par défaut "action")
     */
    public function __construct(string $name_of_action_key = "action")
    {
        $this->action_key = $name_of_action_key;
        $this->createControllerList();
        $this->createRouteList();
    }

    /**
     * Crée la liste des contrôleurs
     * Instancie tous les contrôleurs nécessaires à l'application
     */
    private function createControllerList(): void
    {
        $this->ctrlList = [
            'main' => new MainController(),
            'perso' => new PersoController()
        ];
    }

    /**
     * Crée la liste des routes
     * Associe chaque action à sa route correspondante
     */
    private function createRouteList(): void
    {
        $this->routeList = [
            'index' => new Route\RouteIndex($this->ctrlList['main']),
            'add-perso' => new Route\RouteAddPerso($this->ctrlList['perso']),
            'edit-perso' => new Route\RouteEditPerso($this->ctrlList['perso']),
            'del-perso' => new Route\RouteDelPerso($this->ctrlList['perso']),
            'add-perso-element' => new Route\RouteAddElement($this->ctrlList['perso']),
            'logs' => new Route\RouteLogs($this->ctrlList['main']),
            'login' => new Route\RouteLogin($this->ctrlList['main'])
        ];
    }

    /**
     * Effectue le routage en fonction des paramètres GET et POST
     * @param array $get Paramètres GET
     * @param array $post Paramètres POST
     */
    public function routing(array $get, array $post): void
    {
        try {
            // Vérifier si une action est spécifiée
            if (isset($get[$this->action_key])) {
                $action = $get[$this->action_key];

                // Vérifier si la route existe
                if (isset($this->routeList[$action])) {
                    $route = $this->routeList[$action];

                    // Déterminer la méthode HTTP
                    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

                    // Si POST et que des données POST existent
                    if ($method === 'POST' && !empty($post)) {
                        $route->action($post, 'POST');
                    } else {
                        $route->action($get, 'GET');
                    }
                } else {
                    // Route non trouvée, redirection vers l'index
                    $this->redirectToIndex("Action '$action' non trouvée");
                }
            } else {
                // Pas d'action spécifiée, afficher l'index
                $this->routeList['index']->action();
            }
        } catch (Exception $e) {
            // En cas d'erreur, afficher une page d'erreur
            $this->displayError($e->getMessage());
        }
    }

    /**
     * Redirige vers la page d'accueil avec un message optionnel
     * @param string|null $message Message à afficher
     */
    private function redirectToIndex(?string $message = null): void
    {
        if ($message) {
            $this->routeList['index']->action(['message' => $message]);
        } else {
            $this->routeList['index']->action();
        }
    }

    /**
     * Affiche une page d'erreur
     * @param string $errorMessage Message d'erreur
     */
    private function displayError(string $errorMessage): void
    {
        $this->ctrlList['main']->displayError($errorMessage);
    }
}