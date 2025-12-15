<?php

namespace Models;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages de la base de données
     * @return array Tableau de tous les personnages
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, element, unitclass, origin, rarity, url_img as urlImg 
                FROM PERSONNAGE 
                ORDER BY name";
        
        $resultat = $this->execRequest($sql);
        
        return $resultat->fetchAll();
    }

    /**
     * Récupère un personnage par son ID
     * @param string $idPersonnage L'ID du personnage à récupérer
     * @return array|null Les données du personnage ou null si non trouvé
     */
    public function getByID(string $idPersonnage): ?array
    {
        $sql = "SELECT id, name, element, unitclass, origin, rarity, url_img as urlImg 
                FROM PERSONNAGE 
                WHERE id = ?";
        
        $resultat = $this->execRequest($sql, [$idPersonnage]);
        
        $personnage = $resultat->fetch();
        
        // Retourne null si aucun personnage n'est trouvé
        return $personnage ?: null;
    }
}