<?php
require_once("./utils/connexion.php"); 
require_once("./utils/autoload.php"); 

$manager = new Manager($bdd);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $destinationId = $_GET['id'];

    $destination = $manager->getDestinationById($destinationId);

    if ($destination) {
        echo '<h2>' . $destination->getLocation() . '</h2>';
        echo '<p>Prix : ' . $destination->getPrice() . '</p>';
        
        // Récupérez les tour opérateurs qui proposent cette destination
        $tourOperators = $manager->getTourOperatorsByDestinationId($destinationId);
        
        if (!empty($tourOperators)) {
            echo '<h3>Tour Opérateurs :</h3>';
            echo '<ul>';
            foreach ($tourOperators as $tourOperator) {
                echo '<li>' . $tourOperator->getName() . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>Aucun Tour Opérateur ne propose cette destination.</p>';
        }
    } else {
        echo '<p>Destination non trouvée.</p>';
    }
} else {
    echo '<p>Aucune destination sélectionnée.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
