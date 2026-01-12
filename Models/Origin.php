<?php

namespace Models;

class Origin
{
    private ?int $id;
    private string $name;
    private string $urlImg;

    public function __construct(array $data = [])
    {
        $this->id = null;
        if (!empty($data)) {
            $this->hydrate($data);
        }
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
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrlImg(): string
    {
        return $this->urlImg;
    }

    // Setters
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setUrlImg(string $urlImg): void
    {
        $this->urlImg = $urlImg;
    }
}