<?php

namespace Services;

use Models\Personnage;
use Models\PersonnageDAO;
use Models\Element;
use Models\ElementDAO;
use Models\Origin;
use Models\OriginDAO;
use Models\UnitClass;
use Models\UnitClassDAO;

class PersonnageService
{
    private PersonnageDAO $personnageDAO;
    private ElementDAO $elementDAO;
    private OriginDAO $originDAO;
    private UnitClassDAO $unitClassDAO;

    public function __construct()
    {
        $this->personnageDAO = new PersonnageDAO();
        $this->elementDAO = new ElementDAO();
        $this->originDAO = new OriginDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    /**
     * Récupère tous les personnages avec leurs attributs complets
     */
    public function getAllPersonnages(): array
    {
        $dataPersonnages = $this->personnageDAO->getAll();
        $personnages = [];

        foreach ($dataPersonnages as $data) {
            $personnage = new Personnage();
            $personnage->hydrate($data);

            if ($data['element']) {
                $elementData = $this->elementDAO->getByID($data['element']);
                if ($elementData) {
                    $element = new Element($elementData);
                    $personnage->setElement($element);
                }
            }

            if ($data['unitclass']) {
                $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
                if ($unitClassData) {
                    $unitClass = new UnitClass($unitClassData);
                    $personnage->setUnitclass($unitClass);
                }
            }

            if ($data['origin']) {
                $originData = $this->originDAO->getByID($data['origin']);
                if ($originData) {
                    $origin = new Origin($originData);
                    $personnage->setOrigin($origin);
                }
            }

            $personnages[] = $personnage;
        }

        return $personnages;
    }

    /**
     * Récupère un personnage par son ID avec ses attributs complets
     */
    public function getPersonnageById(string $id): ?Personnage
    {
        $data = $this->personnageDAO->getByID($id);

        if ($data === null) {
            return null;
        }

        $personnage = new Personnage();
        $personnage->hydrate($data);

        if ($data['element']) {
            $elementData = $this->elementDAO->getByID($data['element']);
            if ($elementData) {
                $element = new Element($elementData);
                $personnage->setElement($element);
            }
        }

        // Récupérer et attacher l'unitclass
        if ($data['unitclass']) {
            $unitClassData = $this->unitClassDAO->getByID($data['unitclass']);
            if ($unitClassData) {
                $unitClass = new UnitClass($unitClassData);
                $personnage->setUnitclass($unitClass);
            }
        }

        // Récupérer et attacher l'origin
        if ($data['origin']) {
            $originData = $this->originDAO->getByID($data['origin']);
            if ($originData) {
                $origin = new Origin($originData);
                $personnage->setOrigin($origin);
            }
        }

        return $personnage;
    }
}