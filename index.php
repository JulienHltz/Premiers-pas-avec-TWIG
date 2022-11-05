<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once 'vendor/autoload.php';

	$loader = new \Twig\Loader\FilesystemLoader('templates');
	$twig   = new \Twig\Environment($loader);

	$templates = $twig->load('index.twig');

    


    //~ URL appelée nous retournant des données au format JSON
    $data_url = 'http://api.randomuser.me/?results=3';

    //~ On appelle l'URL et on stocke le contenu retourné dans une variable
    $data_contenu = file_get_contents($data_url);

    //~ Les données étant au format JSON, on les décode pour les stocker sous la forme d'un tableau associatif
    $data_array = json_decode($data_contenu, true);

    //~ On pointe directement sur les données du/des utilisateur(s) retourné(s)
    $utilisateurs = $data_array['results'];

    echo $templates->render(
		[
            'data_url' => $data_url,
            'data_contenu' => $data_contenu,
            'data_array' => $data_array,
            'utilisateurs' => $utilisateurs
		]
	);
?>


