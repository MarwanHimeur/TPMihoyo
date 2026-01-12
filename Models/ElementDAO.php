<?php

namespace Models;

class ElementDAO extends BasePDODAO
{
    /**
     * Récupère tous les éléments
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM ELEMENT ORDER BY name";
        $resultat = $this->execRequest($sql);
        return $resultat->fetchAll();
    }

    /**
     * Récupère un élément par son ID
     */
    public function getByID(int $id): ?array
    {
        $sql = "SELECT id, name, url_img as urlImg FROM ELEMENT WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        $element = $resultat->fetch();
        return $element ?: null;
    }

    /**
     * Crée un nouvel élément
     */
    public function create(Element $element): Element
    {
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (?, ?)";
        $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg()
        ]);
        
        // Récupérer l'ID auto-généré
        $element->setId((int)$this->execRequest("SELECT LAST_INSERT_ID() as id")->fetch()['id']);
        
        return $element;
    }

    /**
     * Met à jour un élément
     */
    public function edit(Element $element): int
    {
        $sql = "UPDATE ELEMENT SET name = ?, url_img = ? WHERE id = ?";
        $resultat = $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg(),
            $element->getId()
        ]);
        return $resultat->rowCount();
    }

    /**
     * Supprime un élément
     */
    public function delete(int $id): int
    {
        $sql = "DELETE FROM ELEMENT WHERE id = ?";
        $resultat = $this->execRequest($sql, [$id]);
        return $resultat->rowCount();
    }
}