<?php

// function loadClass($classe)
// {
//     // Vérifiez si la classe est un repository (Repository)
//     if (substr($classe, -strlen('Repository')) === 'Repository') {
//         require_once 'repository/' . $classe . '.php';
//     } else {
//         require_once 'entity/' . $classe . '.php';
//     }
// }

// spl_autoload_register('loadClass');


function chargerClasse($classname)
{
    // require DIR . '/../../Model/Repository/' . $classname . '.php';
    // require DIR . '/../../Model/Entity/' . $classname . '.php';
    if ($classname === 'Manager') {
        require $_SERVER['DOCUMENT_ROOT'] . '/tp-tour-operator/repository/' . $classname . '.php';
    } else {
        require $_SERVER['DOCUMENT_ROOT'] . '/tp-tour-operator/entity/' . $classname . '.php';
    }
}

spl_autoload_register('chargerClasse');