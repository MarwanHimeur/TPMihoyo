<?php
namespace Controllers;

use League\Plates\Engine;

/*
 * Contrôleur principal de l'application
 */
class MainController
{
    /**
     * Permet de générer les vues HTML
     */
    private Engine $templates;

    /**
     * Constructeur 
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
    }

    /**
     * Méthode index : affiche la page d'accueil
     */
    public function index(): void
    {
        // render() génère le HTML de la vue
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact'
        ]);
    }
}