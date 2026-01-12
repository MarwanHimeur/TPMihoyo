<?php
namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;
use Models\Personnage;
use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;
use Models\Element;
use Models\Origin;
use Models\UnitClass;

/**
 * Contrôleur pour la gestion des personnages
 */
class PersoController
{
    private Engine $templates;
    private PersonnageService $personnageService;
    private PersonnageDAO $personnageDAO;
    private ElementDAO $elementDAO;
    private OriginDAO $originDAO;
    private UnitClassDAO $unitClassDAO;
    private MainController $mainController;

    public function __construct()
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->personnageService = new PersonnageService();
        $this->personnageDAO = new PersonnageDAO();
        $this->elementDAO = new ElementDAO();
        $this->originDAO = new OriginDAO();
        $this->unitClassDAO = new UnitClassDAO();
        $this->mainController = new MainController();
    }

    /**
     * Affiche le formulaire d'ajout de personnage
     */
    public function displayAddPerso(?string $message = null): void
    {
        // Récupérer les listes pour les selects
        $elements = $this->elementDAO->getAll();
        $unitclasses = $this->unitClassDAO->getAll();
        $origins = $this->originDAO->getAll();

        echo $this->templates->render('add-perso', [
            'title' => 'Ajouter un personnage',
            'message' => $message,
            'elements' => $elements,
            'unitclasses' => $unitclasses,
            'origins' => $origins
        ]);
    }

    /**
     * Ajoute un personnage en base de données
     */
    public function addPerso(array $dataPerso): void
    {
        $dataPerso['id'] = uniqid();

        $personnage = new Personnage();
        $personnage->hydrate($dataPerso);

        $result = $this->personnageDAO->createPersonnage($personnage);

        if ($result) {
            $message = "Le personnage {$personnage->getName()} a été créé avec succès !";
            $this->log("CREATE", "Personnage créé : {$personnage->getName()} (ID: {$personnage->getId()})");
        } else {
            $message = "Erreur lors de la création du personnage.";
            $this->log("ERROR", "Échec création personnage : {$personnage->getName()}");
        }

        $this->mainController->index($message);
    }

    /**
     * Affiche le formulaire d'édition avec les données du personnage
     */
    public function displayEditPerso(string $idPerso, ?string $message = null): void
    {
        $personnage = $this->personnageService->getPersonnageById($idPerso);

        if (!$personnage) {
            $this->displayAddPerso("Personnage introuvable.");
            return;
        }

        $elements = $this->elementDAO->getAll();
        $unitclasses = $this->unitClassDAO->getAll();
        $origins = $this->originDAO->getAll();

        echo $this->templates->render('edit-perso', [
            'title' => 'Modifier un personnage',
            'personnage' => $personnage,
            'message' => $message,
            'elements' => $elements,
            'unitclasses' => $unitclasses,
            'origins' => $origins
        ]);
    }

    /**
     * Met à jour un personnage en base de données
     */
    public function editPersoAndIndex(array $dataPerso): void
    {
        $personnage = new Personnage();
        $personnage->hydrate($dataPerso);

        $result = $this->personnageDAO->updatePersonnage($personnage);

        if ($result > 0) {
            $message = "Le personnage {$personnage->getName()} a été modifié avec succès !";
            $this->log("UPDATE", "Personnage modifié : {$personnage->getName()} (ID: {$personnage->getId()})");
        } else {
            $message = "Erreur lors de la modification du personnage.";
            $this->log("ERROR", "Échec modification personnage ID: {$personnage->getId()}");
        }

        $this->mainController->index($message);
    }

    /**
     * Supprime un personnage et affiche l'index
     */
    public function deletePersoAndIndex(string $idPerso = ""): void
    {
        if (empty($idPerso)) {
            $this->mainController->index("Erreur : ID du personnage manquant.");
            return;
        }

        $personnage = $this->personnageService->getPersonnageById($idPerso);
        $nom = $personnage ? $personnage->getName() : "Inconnu";

        $rowCount = $this->personnageDAO->deletePerso($idPerso);

        if ($rowCount > 0) {
            $message = "Le personnage a été supprimé avec succès !";
            $this->log("DELETE", "Personnage supprimé : $nom (ID: $idPerso)");
        } else {
            $message = "Erreur : Personnage introuvable ou déjà supprimé.";
            $this->log("ERROR", "Échec suppression personnage ID: $idPerso");
        }

        $this->mainController->index($message);
    }

    /**
     * Affiche le formulaire d'ajout d'élément
     */
    public function displayAddElement(?string $message = null): void
    {
        echo $this->templates->render('add-element', [
            'title' => 'Ajouter un élément',
            'message' => $message
        ]);
    }

    /**
     * Ajoute un attribut (element, origin, unitclass)
     * CETTE MÉTHODE ÉTAIT MANQUANTE !
     */
    public function addAttribute(string $type, string $name, string $urlImg): void
    {
        try {
            switch ($type) {
                case 'element':
                    $element = new Element(['name' => $name, 'urlImg' => $urlImg]);
                    $this->elementDAO->create($element);
                    $message = "L'élément $name a été créé avec succès !";
                    $this->log("CREATE", "Élément créé : $name");
                    break;

                case 'origin':
                    $origin = new Origin(['name' => $name, 'urlImg' => $urlImg]);
                    $this->originDAO->create($origin);
                    $message = "La région $name a été créée avec succès !";
                    $this->log("CREATE", "Région créée : $name");
                    break;

                case 'unitclass':
                    $unitclass = new UnitClass(['name' => $name, 'urlImg' => $urlImg]);
                    $this->unitClassDAO->create($unitclass);
                    $message = "L'arme $name a été créée avec succès !";
                    $this->log("CREATE", "Arme créée : $name");
                    break;

                default:
                    $message = "Type d'attribut invalide.";
                    $this->log("ERROR", "Type d'attribut invalide : $type");
            }
        } catch (\Exception $e) {
            $message = "Erreur lors de la création : " . $e->getMessage();
            $this->log("ERROR", "Erreur création attribut $type : " . $e->getMessage());
        }

        $this->mainController->index($message);
    }

    /**
     * Enregistre une action dans le fichier de log
     */
    private function log(string $action, string $details): void
    {
        $logDir = __DIR__ . '/../logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $filename = $logDir . '/MIHOYO_' . date('m_Y') . '.log';
        $logEntry = '[' . date('Y-m-d H:i:s') . '] ' . $action . ' - ' . $details . PHP_EOL;
        file_put_contents($filename, $logEntry, FILE_APPEND);
    }
}