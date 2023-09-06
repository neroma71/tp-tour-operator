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
    <form action="traitement.php" method="post">
    <h2>Ajouter un Tour-Opérateur</h2>
    <label for="name">Nom du Tour-Opérateur :</label>
    <input type="text" id="name" name="name" required>
    <label for="grade_count">grade Count :</label>
    <input type="number" id="grade_count" name="grade_count" required>
    <label for="grade_total">grade_total :</label>
    <input type="number" id="grade_total" name="grade_total" required>
    <label for="is_premium">Premium :</label>
    <select id="is_premium" name="is_premium">
        <option value="0">Non</option>
        <option value="1">Oui</option>
    </select>
    <label for="link">Lien :</label>
    <input type="text" id="link" name="link">
    <input type="submit" value="Ajouter">
</form>

<!-- ajouter destination a une TO-->
        <h2>Ajouter une Destination à un Tour-Opérateur</h2>
    <form method="post" action="traitement.php" enctype="multipart/form-data">
        <label for="location">location :</label>
        <input type="text" id="location" name="location">
        <label for="price">price :</label>
        <input type="number" id="price" name="price">
        <label for="tour_operator_id">Tour-Opérateur :</label>
        <select name="tour_operator_id">
        <option>rentrer un tour operator</option>
        <?php
        $tourOps = $manager->getAllOperator();
            foreach ($tourOps as $tourOp) {
                 echo '<option value="'.$tourOp->getId().'">'.$tourOp->getName().'</option>';
                }
        ?>
    </select>
        <input type="file" name="image">
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>