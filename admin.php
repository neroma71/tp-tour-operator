
<?php
session_start();
// Mot de passe à vérifier
$motDePasseAttendu = "admin123"; // Changez ceci par votre mot de passe réel

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['connexion'])) {
    $motDePasseSoumis = $_POST['mot_de_passe'];

    // Vérifier si le mot de passe soumis correspond au mot de passe attendu
    if ($motDePasseSoumis === $motDePasseAttendu) {
        // Authentification réussie, stockez un indicateur de connexion en session
        $_SESSION['authenticated'] = true;
    } else {
        echo "Mot de passe incorrect. Veuillez réessayer.";
    }
}

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // L'administrateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: pageDeConnexion.php");
    exit();
}

// L'administrateur est connecté, affichez la page d'administration
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <?php

    require_once './Utils/db_connect.php';
    require_once './Utils/loadClass.php';
    $manager = new TourOperateurRepository($bdd);
    ?>
    <div class="containerAdmin">
        <h2>Espace Administration</h2>
<div class="ajoutTO" >
    <h3>Ajouter Tour Operateur :</h3>
    <form action="processTourOperator.php" method="POST" enctype="multipart/form-data">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br>

        <label for="link">Lien :</label>
        <input type="text" id="link" name="link" required><br>

        <label for="is_premium">Premium :</label>
        <input type="checkbox" id="is_premium" name="is_premium"><br>


        <label for="img">Image :</label>
        <input type="file" id="imgage" name="image" accept="image/*">
 

        <input type="submit" value="Créer l'opérateur">
    </form>

    </div>

    <div  class="ajoutDes">
    
    <h3>Ajouter une Destination à un Tour-Opérateur :</h3>
    <form method="post" action="processDestination.php" enctype="multipart/form-data">
        <label for="location">location :</label>
        <input type="text" id="location" name="location">
        <label for="price">price :</label>
        <input type="number" id="price" name="price">
        <label for="tour_operator_id">Tour-Opérateur :</label>
        <select name="tour_operator_id">
            <option>Selectionner un tour operator</option>
            <?php
            $tourOps = $manager->getAllOperator();
            foreach ($tourOps as $tourOp) {
                echo '<option value="' . $tourOp->getId() . '">' . $tourOp->getName() . '</option>';
            }
            ?>
        </select>
        <label for="image">Image :</label>
        <input type="file" id="image" name="image" accept="image/*">
        <input type="submit" value="Ajouter">
    </form>
    </div>

    <div class="update">
    <form action="processPremium.php" method="post">
    <h3>Mettre à jour un Tour-Opérateur :</h3>
    <label for="tour_operator_id">Sélectionnez le Tour-Opérateur :</label>
    <select id="tour_operator_id" name="tour_operator_id">
    <?php
    $tourOpsIdName = $manager->getTourOperatorNameAndId()
    ?>
    </select>
    <label for="is_premium">Passer en Premium :</label>
    <select id="is_premium" name="is_premium">
        <option value="0">Non</option>
        <option value="1">Oui</option>
    </select>
    <input type="submit" name="updateOperator" value="Mettre à jour">
</form>
    </div>
    </div>
</body>

</html>