<?php

namespace Services;

use Models\Personnage;
use Models\PersonnageDAO;

class PersonnageService
{
    private PersonnageDAO $personnageDAO;

    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
    }

    /**
     * Récupère tous les personnages sous forme d'objets Personnage
     * @return array Tableau d'objets Personnage
     */
    public function getAllPersonnages(): array
    {
        $data = $this->personnageDAO->getAll();
        $personnages = [];

        foreach ($data as $row) {
            $personnage = new Personnage();
            $personnage->hydrate($row);
            $personnages[] = $personnage;
        }

        return $personnages;
    }

    /**
     * Récupère un personnage par son ID sous forme d'objet Personnage
     * @param string $id L'ID du personnage
     * @return Personnage|null L'objet Personnage ou null si non trouvé
     */
    public function getPersonnageById(string $id): ?Personnage
    {
        $data = $this->personnageDAO->getByID($id);

        if ($data === null) {
            return null;
        }

        $personnage = new Personnage();
        $personnage->hydrate($data);

        return $personnage;
    }
}