<?php

namespace Models;

class PersonnageDAO extends BasePDODAO
{
    /**
     * Récupère tous les personnages (sans les objets liés)
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
     * Récupère un personnage par son ID (sans les objets liés)
     */
    public function getByID(string $idPersonnage): ?array
    {
        $sql = "SELECT id, name, element, unitclass, origin, rarity, url_img as urlImg 
                FROM PERSONNAGE 
                WHERE id = ?";
        
        $resultat = $this->execRequest($sql, [$idPersonnage]);
        
        $personnage = $resultat->fetch();
        
        return $personnage ?: null;
    }

    /**
     * Crée un nouveau personnage
     */
    public function createPersonnage(Personnage $personnage): bool
    {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $resultat = $this->execRequest($sql, [
            $personnage->getId(),
            $personnage->getName(),
            $personnage->getElement()?->getId(),
            $personnage->getUnitclass()?->getId(),
            $personnage->getOrigin()?->getId(),
            $personnage->getRarity(),
            $personnage->getUrlImg()
        ]);

        return $resultat !== false;
    }

    /**
     * Met à jour un personnage existant
     */
    public function updatePersonnage(Personnage $personnage): int
    {
        $sql = "UPDATE PERSONNAGE 
                SET name = ?, element = ?, unitclass = ?, origin = ?, rarity = ?, url_img = ?
                WHERE id = ?";
        
        $resultat = $this->execRequest($sql, [
            $personnage->getName(),
            $personnage->getElement()?->getId(),
            $personnage->getUnitclass()?->getId(),
            $personnage->getOrigin()?->getId(),
            $personnage->getRarity(),
            $personnage->getUrlImg(),
            $personnage->getId()
        ]);

        return $resultat->rowCount();
    }

    /**
     * Supprime un personnage par son ID
     */
    public function deletePerso(string $idPerso): int
    {
        $sql = "DELETE FROM PERSONNAGE WHERE id = ?";
        
        $resultat = $this->execRequest($sql, [$idPerso]);
        
        return $resultat->rowCount();
    }
}