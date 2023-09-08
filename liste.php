<?php
    require_once("./utils/db_connect.php"); 
    require_once("./utils/loadClass.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<?php
include('./partiel/header.php');
?>
<body>
    
<?php
require_once("./utils/db_connect.php"); 
require_once("./utils/loadClass.php");

$manager = new TourOperateurRepository($bdd);

if (isset($_GET['location']) && !empty($_GET['location'])) {
    $destinations = $manager->getDestinationByLocation($_GET['location']);
    if ($destinations) {
        echo '<div class="destination-info">';
        echo '<h2>Destination: ' . $destinations[0]->getLocation() . '</h2>';
        

        
        echo '<h3>Tour Opérateurs Qui Proposent Cette Destination:</h3>';
        echo '<ul>';
        foreach ($destinations as $destination) {
            $tourOperator = $manager->getTourOperatorById($destination->getTour_operator_id());
            $price = $manager->getPriceById($destination->getTour_operator_id());
            echo '<li>Nom Agence : ' . $tourOperator->getName() . '</li>';
            echo '<li>Prix du voyage : ' . $price . '<li>';
            echo '<li>Site Web: ' . $tourOperator->getLink() . '</li>';
        }
        echo '</ul>';
        echo '</div>';
    } else {
        echo '<p>Destination non trouvée.</p>';
    }
} else {
    echo '<p>Destination non valide.</p>';
}
?>


<h2>Ajouter un Commentaire</h2>
<form method="post" action="lisTrait.php">
    <label for="author">Auteur :</label>
    <input type="text" id="author" name="author" required>
    <br>
    
    <label for="message">Message :</label>
    <textarea id="message" name="message" rows="4" cols="50" required></textarea>
    <br>
    
    <label for="tour_operator_id">Tour-Opérateur :</label>
    <select id="tour_operator_id" name="tour_operator_id" required>
        <option value="">Sélectionner un tour opérateur</option>
        <?php
        $tourOps = $manager->getAllOperator();
        foreach ($tourOps as $tourOp) {
            echo '<option value="' . $tourOp->getId() . '">' . $tourOp->getName() . '</option>';
        }
        ?>
    </select>
    
    <label for="grade_count">grade count :</label>
        <input type="number" id="grade_count" name="grade_count" required>
        

    <label for="grade_total">grade total :</label>
    <input type="number" id="grade_total" name="grade_total" required>
    <br>
    
    <input type="submit" value="Ajouter le Commentaire">
</form>








</body>
</html>