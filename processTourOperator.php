<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Inclure vos classes et initialiser PDO
    require_once './Utils/db_connect.php';
    require_once './Utils/loadClass.php';

    // Récupérer les données soumises depuis le formulaire
    $name = $_POST['name'];
    $link = $_POST['link'];
    $is_premium = isset($_POST['is_premium']) ? 1 : 0;

    // Créer un objet TourOperateur avec les données
    $tourOperateur = new TourOperateur([
        'name' => $name,
        'link' => $link,
        'is_premium' => $is_premium
    ]);

    // Créer un objet TourOperateurRepository avec la connexion PDO
    $tourOperateurRepository = new TourOperateurRepository($bdd);

    // Appeler la méthode createTourOperator pour insérer le nouvel opérateur
    $insertedId = $tourOperateurRepository->createTourOperator($tourOperateur);

    if ($insertedId !== false) {
        echo "L'opérateur a été créé avec l'identifiant $insertedId.";
    } else {
        echo "Une erreur s'est produite lors de la création de l'opérateur.";
    }
    ?>
</body>

</html>