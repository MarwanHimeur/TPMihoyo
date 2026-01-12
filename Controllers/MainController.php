<?php
namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;

/**
 * Contrôleur principal de l'application
 */
class MainController
{
    /**
     * Permet de générer les vues HTML
     */
    private Engine $templates;

    /**
     * Service de gestion des personnages
     */
    private PersonnageService $personnageService;

    /**
     * Constructeur 
     */
    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->personnageService = new PersonnageService();
    }

    /**
     * Méthode index : affiche la page d'accueil avec la liste des personnages
     * @param string|null $message Message optionnel à afficher
     */
    public function index(?string $message = null): void
    {
        $listPersonnage = $this->personnageService->getAllPersonnages();

        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'message' => $message
        ]);
    }

    /**
     * Affiche la page des logs
     */
    public function displayLogs(): void
    {
        echo $this->templates->render('logs', [
            'title' => 'Journal des logs'
        ]);
    }

    /**
     * Affiche la page de connexion
     */
    public function displayLogin(): void
    {
        echo $this->templates->render('login', [
            'title' => 'Connexion'
        ]);
    }

    /**
     * Affiche une page d'erreur
     * @param string $errorMessage Message d'erreur
     */
    public function displayError(string $errorMessage): void
    {
        echo $this->templates->render('error', [
            'title' => 'Erreur',
            'errorMessage' => $errorMessage
        ]);
    }
}