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
    $location = $_POST['location'];
    $price = $_POST['price'];
    $tour_operator_id = $_POST['tour_operator_id'];

    // Créer un objet TourOperateur avec les données
    $destination = new Destination([
        'location' => $location,
        'price' => $price,
        'tour_operator_id' => $tour_operator_id
    ]);

    // Créer un objet TourOperateurRepository avec la connexion PDO
    $tourOperateurRepository = new TourOperateurRepository($bdd);

    // Appeler la méthode createTourOperator pour insérer le nouvel opérateur
    $insertedId = $tourOperateurRepository->createDestination($destination);

    if ($insertedId !== false) {
        echo "La destination a été créé avec l'identifiant $insertedId.";
    } else {
        echo "Une erreur s'est produite lors de la création de la destination.";
    }
    ?>
</body>

</html>