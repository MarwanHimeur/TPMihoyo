<?php

namespace Models;

class OriginDAO extends BasePDODAO
{
    /**
     * Récupère toutes les origines
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM ORIGIN ORDER BY name";
        $resultat = $this->execRequest($sql);
        return $resultat->fetchAll();
    }

    /**
     * Récupère une origine par son ID
     */
    public function getByID(int $id): ?array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM ORIGIN WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        $origin = $resultat->fetch();
        return $origin ?: null;
    }

    /**
     * Crée une nouvelle origine
     */
    public function create(Origin $origin): Origin
    {
        $sql = "INSERT INTO ORIGIN (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg()
        ]);
        
        // Récupérer l'ID auto-généré
        $origin->setId((int)$this->execRequest("SELECT LAST_INSERT_ID() as id")->fetch()['id']);
        
        return $origin;
    }

    /**
     * Met à jour une origine
     */
    public function edit(Origin $origin): int
    {
        $sql = "UPDATE ORIGIN SET name = ?, url_img = ? WHERE id = ?";
        $resultat = $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg(),
            $origin->getId()
        ]);
        return $resultat->rowCount();
    }

    /**
     * Supprime une origine
     */
    public function delete(int $id): int
    {
        $sql = "DELETE FROM ORIGIN WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        return $resultat->rowCount();
    }
}