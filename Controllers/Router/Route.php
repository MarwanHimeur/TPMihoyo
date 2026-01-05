<?php

namespace Controllers\Router;

use Exception;

/**
 * Classe abstraite Route
 * Sert de base pour toutes les routes de l'application
 */
abstract class Route
{
    /**
     * Méthode principale qui dispatche vers GET ou POST
     * @param array $params Paramètres de la requête
     * @param string $method Méthode HTTP (GET ou POST)
     */
    public function action(array $params = [], string $method = 'GET'): void
    {
        if ($method === 'POST') {
            $this->post($params);
        } else {
            $this->get($params);
        }
    }

    /**
     * Récupère un paramètre dans un tableau avec validation
     * @param array $array Le tableau contenant les paramètres ($_GET ou $_POST)
     * @param string $paramName Le nom du paramètre à récupérer
     * @param bool $canBeEmpty Si false, le paramètre ne peut pas être vide
     * @return mixed La valeur du paramètre
     * @throws Exception Si le paramètre est absent ou vide (quand canBeEmpty=false)
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName];
        } else {
            throw new Exception("Paramètre '$paramName' absent");
        }
    }

    /**
     * Méthode à implémenter pour gérer les requêtes GET
     * @param array $params Paramètres GET
     */
    abstract public function get(array $params = []): void;

    /**
     * Méthode à implémenter pour gérer les requêtes POST
     * @param array $params Paramètres POST
     */
    abstract public function post(array $params = []): void;
}