<?php
require_once("./utils/connexion.php"); 
require_once("./utils/autoload.php"); 

$manager = new Manager($bdd);

if (isset($_GET['location']) && !empty($_GET['location'])) {
   
    $destinations = $manager->getDestinationByLocation($_GET['location']);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/liste.css">
</head>
<body>
    <header>
    <h1>Comparo.FR</h1>
    </header>
    <?php
        if ($destinations) {
        echo '<section>';
        echo '<div class="row text-center titre">';
            echo '<h2>destination : '.$destinations[0]->getLocation().'</h2>';
            echo '<h3>Liste des Tours Opérateurs :</h3>';
        echo '</div>';
        echo '<div class="row d-felx justify-content-center affichage">';
            foreach ($destinations as $destination) {
                $tourOperator = $manager->getTourOperatorById($destination->getTour_operator_id());
                echo '<a href="tourop.php?id='.$tourOperator->getId().'">';
                    echo '<p>' . $tourOperator->getName() . '</p>';
                     echo '<p>' . $tourOperator->getLink() . '</p>';
                echo '</a>';
            }
        echo '</div>';
        
         echo '</section>' ;
    } else {
        echo '<p>Destination non trouvée.</p>';
    }
} else {
    echo '<p>Destination non valide.</p>';
}
    ?>
</body>
</html>
