<?php

namespace Config;

use Exception;

class Config
{
    private static $param;

    /**
     * Renvoie la valeur d'un paramètre de configuration
     * @param string $nom Le nom du paramètre à récupérer
     * @param mixed $valeurParDefaut La valeur par défaut si le paramètre n'existe pas
     * @return mixed La valeur du paramètre ou la valeur par défaut
     */
    public static function get($nom, $valeurParDefaut = null)
    {
        if (isset(self::getParameter()[$nom])) {
            $valeur = self::getParameter()[$nom];
        } else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    /**
     * Renvoie le tableau des paramètres en le chargeant au besoin
     * Charge en priorité prod.ini, puis dev.ini si prod.ini n'existe pas
     * @return array Le tableau des paramètres de configuration
     * @throws Exception Si aucun fichier de configuration n'est trouvé
     */
    private static function getParameter()
    {
        if (self::$param == null) {
            $cheminFichier = "Config/prod.ini";
            if (!file_exists($cheminFichier)) {
                $cheminFichier = "Config/dev.ini";
            }
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouvé");
            } else {
                self::$param = parse_ini_file($cheminFichier);
            }
        }
        return self::$param;
    }
}