<?php
namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;

/**
 * Contrôleur pour la gestion des personnages
 */
class PersoController
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
     * Affiche le formulaire d'ajout/édition de personnage
     * @param string|null $id ID du personnage à éditer (null pour un ajout)
     */
    public function displayAddPerso(?string $id = null): void
    {
        $personnage = null;
        $isEdit = false;

        // Si un ID est fourni, on récupère le personnage pour édition
        if ($id !== null) {
            $personnage = $this->personnageService->getPersonnageById($id);
            $isEdit = true;
        }

        echo $this->templates->render('add-perso', [
            'title' => $isEdit ? 'Modifier un personnage' : 'Ajouter un personnage',
            'personnage' => $personnage,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * Affiche le formulaire d'ajout d'élément (element, weapon, origin)
     */
    public function displayAddElement(): void
    {
        echo $this->templates->render('add-element', [
            'title' => 'Ajouter un élément'
        ]);
    }

    /**
     * Supprime un personnage et redirige vers l'index
     * @param string $id ID du personnage à supprimer
     */
    public function deletePerso(string $id): void
    {
        // Pour le moment, on fait juste une redirection avec un message
        // La vraie suppression sera implémentée dans le prochain TP
        
        // Redirection vers l'index avec un message
        header('Location: index.php?message=' . urlencode("Le personnage sera supprimé (fonctionnalité à venir)"));
        exit();
    }
}