<?php


// Appelle des modèles
$dir = "./PHP";
$dossier = opendir($dir);
while ($fichier = readdir($dossier)) {
    if (is_file($dir . '/' . $fichier) && $fichier != '/' && $fichier != '.' && $fichier != '..') {
        include_once $dir . '/' . $fichier;
    }
}
closedir($dossier);


