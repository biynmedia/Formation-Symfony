<?php

use Symfony\Component\VarDumper\VarDumper;

# Importation de l'Autoload de Composer
require_once 'vendor/autoload.php';


# Contenu de Démonstration
class Contact {
    private $_firstname,
            $_lastname;

    /**
     * contact constructor.
     * @param $_firstname
     * @param $_lastname
     */
    public function __construct($_firstname, $_lastname)
    {
        $this->_firstname = $_firstname;
        $this->_lastname = $_lastname;
    }
}

$unString   = 'Une Chaine de Caractère';
$unArray    = ['Hugo', 'Jean', 'Luc', 'Marc'];
$unObjet    = new Contact('Hugo','LIEGEARD');

# Test de VarDumper
VarDumper::dump($unString);
VarDumper::dump($unArray);
VarDumper::dump($unObjet);
