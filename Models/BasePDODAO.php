<?php

namespace Models;

use Config\Config;
use PDO;
use PDOStatement;

abstract class BasePDODAO
{
    /**
     * Instance de connexion PDO
     */
    private $db;

    /**
     * Récupère ou crée l'instance PDO de connexion à la base de données
     * @return PDO L'instance de connexion PDO
     */
    private function getDB(): PDO
    {
        if ($this->db == null) {
            // Récupération des paramètres de connexion depuis Config
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');

            // Création de la connexion PDO
            $this->db = new PDO($dsn, $user, $pass);
            
            // Configuration de PDO pour lever des exceptions en cas d'erreur
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Configuration pour retourner les résultats en tableaux associatifs
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        return $this->db;
    }

    /**
     * Exécute une requête SQL préparée
     * @param string $sql La requête SQL à exécuter
     * @param array|null $params Les paramètres de la requête préparée (optionnel)
     * @return PDOStatement|false Le résultat de la requête ou false en cas d'erreur
     */
    protected function execRequest(string $sql, ?array $params = null): PDOStatement|false
    {
        if ($params == null) {
            // Requête simple sans paramètres
            $resultat = $this->getDB()->query($sql);
        } else {
            // Requête préparée avec paramètres
            $resultat = $this->getDB()->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;
    }
}