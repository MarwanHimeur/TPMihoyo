<?php

namespace Models;

class UnitClassDAO extends BasePDODAO
{
    /**
     * Récupère toutes les classes d'armes
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM UNITCLASS ORDER BY name";
        $resultat = $this->execRequest($sql);
        return $resultat->fetchAll();
    }

    /**
     * Récupère une classe d'arme par son ID
     */
    public function getByID(int $id): ?array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM UNITCLASS WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        $unitclass = $resultat->fetch();
        return $unitclass ?: null;
    }

    /**
     * Crée une nouvelle classe d'arme
     */
    public function create(UnitClass $unitclass): UnitClass
    {
        $sql = "INSERT INTO UNITCLASS (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [
            $unitclass->getName(),
            $unitclass->getUrlImg()
        ]);
        
        // Récupérer l'ID auto-généré
        $unitclass->setId((int)$this->execRequest("SELECT LAST_INSERT_ID() as id")->fetch()['id']);
        
        return $unitclass;
    }

    /**
     * Met à jour une classe d'arme
     */
    public function edit(UnitClass $unitclass): int
    {
        $sql = "UPDATE UNITCLASS SET name = ?, url_img = ? WHERE id = ?";
        $resultat = $this->execRequest($sql, [
            $unitclass->getName(),
            $unitclass->getUrlImg(),
            $unitclass->getId()
        ]);
        return $resultat->rowCount();
    }

    /**
     * Supprime une classe d'arme
     */
    public function delete(int $id): int
    {
        $sql = "DELETE FROM UNITCLASS WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        return $resultat->rowCount();
    }
}