<?php

function loadClass($classe)
{
    // Vérifiez si la classe est un repository (Repository)
    if (substr($classe, -strlen('Repository')) === 'Repository') {
        require_once 'repository/' . $classe . '.php';
    } else {
        require_once 'entity/' . $classe . '.php';
    }
}

spl_autoload_register('loadClass');