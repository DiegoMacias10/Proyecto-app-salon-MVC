<?php

function debug($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo(string $actual, string $proximo): bool {
    if($actual!==$proximo) {
        return true;
    } else {
        return false;
    }
}

//Funcion que revisa que el usuario esta utenticado
function isAuth() {
    if(!isset($_SESSION['login'])) { //Si no esta definida la variable y no esta como true, regresa al usuario al login
        header('Location: /');
    }
}   

function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}