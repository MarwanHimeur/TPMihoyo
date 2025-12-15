<?php
namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;

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
     */
    public function index(): void
    {
        // Récupération de tous les personnages
        $listPersonnage = $this->personnageService->getAllPersonnages();
        
        // Pour tester : récupération d'un personnage spécifique
        // IMPORTANT : Remplace '67584a1b2f3c9' par un ID qui existe dans ta base de données
        $first = $this->personnageService->getPersonnageById('67584a1b2f3c9');
        
        // Test avec un ID qui n'existe pas
        $other = $this->personnageService->getPersonnageById('id_inexistant');

        // render() génère le HTML de la vue avec les données
        echo $this->templates->render('home', [
            'gameName' => 'Genshin Impact',
            'listPersonnage' => $listPersonnage,
            'first' => $first,
            'other' => $other
        ]);
    }
}