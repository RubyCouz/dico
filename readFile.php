<?php
// définition const contenant chemin vers racine du projet
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// ouverture du fichier et stockage sous forme de tableau
$fileReader = file(ROOT . '/dico/list.txt');
// définition d'un tableau et d'une variable de comptage d'erreur
$dico = [];
$count = 0;
$regexTag = '/^[\@][a-zA-Z]+[\#][\d]{4}$/';
$regexBot = '/^[\!][a-z]+$/';
// parcours du tableau (fichier) et stockage dans un tableau sous utf8
foreach ($fileReader as $key => $value) {
    array_push($dico, trim(utf8_encode($value)));
}
// si une donnée est envoyé
if (isset($_POST['value'])) {

    // définitions d'un tableau d'erreur
//    $error = [];
    // séparation de la valeur récupérer et stockage dans un tableau
    $valueArray = explode(' ', $_POST['value']);
    // par cour du tableau contenant la valuer envoyé
    foreach ($valueArray as $key => $value) {
        // si la valeur saisie n'est pas dans le dico
        if(!preg_match($regexTag, $value) && filter_var($value, FILTER_VALIDATE_URL) === false && !preg_match($regexBot, $value)) {
            if (!in_array($value, $dico)) {
                $count++;
//            array_push($error, $value);
            }
        }

    }
    echo $count;
}