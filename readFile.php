<?php
// définition const contenant chemin vers racine du projet
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// ouverture du fichier et stockage sous forme de tableau
$fileReader = file(ROOT . '/dico/list.txt');
// définition d'un tableau et d'une variable de comptage d'erreur
$dico = [];
$count = 0;
$regexTag = '/<@.?[0-9]*?>/';
$regexBot = '/^[\!][a-z]+$/';
$regexReact = '/^(\u00a9|\u00ae|[\u2000-\u3300]|\ud83c[\ud000-\udfff]|\ud83d[\ud000-\udfff]|\ud83e[\ud000-\udfff])$/';
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
        if(!preg_match($regexTag, $value) && filter_var($value, FILTER_VALIDATE_URL) === false && !preg_match($regexBot, $value) && !preg_match($regexReact, utf8_decode($value))) {
            $value = htmlspecialchars($value);
            echo $value;
            if (!in_array($value, $dico)) {
                $count++;
//            array_push($error, $value);
            }
        }

    }

//    echo $count;
}