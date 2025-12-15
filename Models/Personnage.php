<?php

namespace Models;

class Personnage
{
    private ?string $id;
    private string $name;
    private string $element;
    private string $unitclass;
    private int $rarity;
    private ?string $origin;
    private string $urlImg;

    /**
     * Constructeur du personnage
     */
    public function __construct()
    {
        $this->id = null;
        $this->origin = null;
    }

    /**
     * Hydrate l'objet Personnage à partir d'un tableau associatif
     * @param array $data Tableau associatif contenant les données
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Convertir snake_case en camelCase pour les setters
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // ==================== GETTERS ====================

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getElement(): string
    {
        return $this->element;
    }

    public function getUnitclass(): string
    {
        return $this->unitclass;
    }

    public function getRarity(): int
    {
        return $this->rarity;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    // ==================== SETTERS ====================

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setElement(string $element): void
    {
        $this->element = $element;
    }

    public function setUnitclass(string $unitclass): void
    {
        $this->unitclass = $unitclass;
    }

    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

    public function setOrigin(?string $origin): void
    {
        $this->origin = $origin;
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }
}