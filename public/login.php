<?php

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new \Twig\Environment($loader, [
    // activation du mode debug
    'debug' => true,
    // activation du mode de variables strictes
    'strict_variables' => true,
]);

// chargement de l'extension Twig_Extension_Debug
$twig->addExtension(new \Twig\Extension\DebugExtension());

$formData = [ //initialisation d'un tableau vide pour le chargement de la page
    'login' => '',
    'password'=> '',
];

if ($_POST) {
    dump($_POST);

    $errors = []; //variables vides pour les remplir selon les situations
    $messages = [];

    if (isset($_POST['login'])) {
        $formData['login'] = $_POST['login']; // remplacement des valeurs par défaut par celles de l'utilisateur si tout est bon
    }

    if (isset($_POST['password'])) {
        $formData['password'] = $_POST['password'];
    }   


    //vérification du login
    if (!isset($_POST['login']) || empty($_POST['login'])) {
        $errors['login'] = true;
        $messages['login'] = "identifiant ou mot de passe incorrect";
    } elseif (strlen($_POST) < 4 || strlen($_POST) > 100){
        $errors['login'] = true;
        $messages['login'] = "identifiant ou mot de passe incorrect";
    } // à refactoriser en un seul if


    //vérification du password
    if (!isset($_POST['password']) || empty($_POST['password'])) {
        $errors['password'] = true;
            $messages['password'] = "identifiant ou mot de passe incorrect";
    } elseif (strlen($_POST) < 4 || strlen($_POST) > 100){
        $errors['password'] = true;
        $messages['password'] = "identifiant ou mot de passe incorrect";
    }


}