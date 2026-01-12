<?php

namespace Models;

class Personnage
{
    private ?string $id;
    private string $name;
    private ?Element $element;
    private ?UnitClass $unitclass;
    private int $rarity;
    private ?Origin $origin;
    private string $urlImg;

    public function __construct()
    {
        $this->id = null;
        $this->element = null;
        $this->unitclass = null;
        $this->origin = null;
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getElement(): ?Element
    {
        return $this->element;
    }

    public function getUnitclass(): ?UnitClass
    {
        return $this->unitclass;
    }

    public function getRarity(): int
    {
        return $this->rarity;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    // Setters
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setElement($element): void
    {
        if ($element instanceof Element) {
            $this->element = $element;
        } elseif (is_int($element)) {
            $this->element = new Element(['id' => $element]);
        }
    }

    public function setUnitclass($unitclass): void
    {
        if ($unitclass instanceof UnitClass) {
            $this->unitclass = $unitclass;
        } elseif (is_int($unitclass)) {
            $this->unitclass = new UnitClass(['id' => $unitclass]);
        }
    }

    public function setRarity(int $rarity): void
    {
        $this->rarity = $rarity;
    }

    public function setOrigin($origin): void
    {
        if ($origin instanceof Origin) {
            $this->origin = $origin;
        } elseif (is_int($origin)) {
            $this->origin = new Origin(['id' => $origin]);
        } elseif ($origin === null || $origin === '') {
            $this->origin = null;
        }
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }
}