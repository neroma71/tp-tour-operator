<?php
require_once("./utils/connexion.php"); 
require_once("./utils/autoload.php"); 

    $manager = new Manager($bdd);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Page d'Administration</title>
</head>

<body>
    <h1>Page d'Administration</h1>
    
    <!-- ajouter TO -->
    <form action="" method="post">
        <h2>Ajouter un Tour-Opérateur</h2>
        <label for="Name">Nom du Tour-Opérateur :</label>
        <input type="text" id="Name" name="Name" required>
        <label for="grade_Count">grade Count :</label>
        <input type="number" id="grade_Count" name="grade_Count" required>
        <label for="grade_total">grade_total :</label>
        <input type="number" id="grade_total" name="grade_total" required>
        <label for="is_Premium">Premium :</label>
        <select id="is_premium" name="is_premium">
            <option value="0">Non</option>
            <option value="1">Oui</option>
        </select>
        <input type="text" id="link" name="link" placeholder="Lien si premiu)">
        <input type="submit" name="addTourOperator" value="Ajouter">


<!-- ajouter destination a une TO-->
        <h2>Ajouter une Destination à un Tour-Opérateur</h2>
    <label for="location">location :</label>
    <input type="text" id="location" name="location" required>
    <label for="price">price :</label>
    <input type="numbre" id="price" name="price" required>
<label for="tourOperator">Tour-Opérateur :</label>
<select name="tourOperator">
    <option>rentrer un tour operator</option>
    <?php
      $tourOps = $manager->getAllOperator();
            foreach ($tourOps as $tourOp) {
        echo '<option value="'.$tourOp->getId().'">'.$tourOp->getName().'</option>';
            }
    ?>
</select>
    <input type="submit" name="addDestination" value="Ajouter">
    </form>

    
    







</body>
</html>