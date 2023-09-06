<?php
    require_once("./utils/db_connect.php"); 
    require_once("./utils/loadClass.php");

$manager = new TourOperateurRepository($bdd);

if (isset($_GET['location']) && !empty($_GET['location'])) {
   
   
 
    $destinations = $manager->getDestinationByLocation($_GET['location']);
    var_dump($destinations);

    if ($destinations) {
        echo '<h2>' . $destinations[0]->getLocation() . '</h2>';
        
        
        echo '<h3>Tour Opérateurs :</h3>';
        echo '<ul>';
            foreach ($destinations as $destination) {
                $tourOperator = $manager->getTourOperatorById($destination->getTour_operator_id());
                echo '<li>' . $tourOperator->getName() . '</li>';
                echo '<li>' . $tourOperator->getLink() . '</li>';
            }
        echo '</ul>';
        
          
    } else {
        echo '<p>Destination non trouvée.</p>';
    }
} else {
    echo '<p>Destination non valide.</p>';
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