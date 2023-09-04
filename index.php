<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    require_once './Utils/db_connect.php';
    require_once './Utils/loadClass.php';
    ?>

    <form action="processTourOperator.php" method="POST" enctype="multipart/form-data">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br>

        <label for="link">Lien :</label>
        <input type="text" id="link" name="link" required><br>

        <label for="is_premium">Premium :</label>
        <input type="checkbox" id="is_premium" name="is_premium"><br>

        <label for="img">Image :</label>
        <input type="file" id="img" name="img" accept="image/*">

        <input type="submit" value="Créer l'opérateur">
    </form>



    <!-- ajouter destination a une TO-->
    <h2>Ajouter une Destination à un Tour-Opérateur</h2>
    <form action="processTourOperator.php" method="POST" enctype="multipart/form-data">
    <label for="location">location :</label>
    <input type="text" id="location" name="location" required>
    <label for="price">price :</label>
    <input type="numbre" id="price" name="price" required>



    
    <label for="tourOperator">Tour-Opérateur :</label>
    <?php
$sql = "SELECT name FROM tour_operator ";
$result = $bdd->query($sql);


$rows = $result->fetchAll(PDO::FETCH_ASSOC);



echo '<select name="tour_operator">'; 
foreach ($rows as $row) {
    echo '<option value="' .  $row['name'] . '">' . $row['name'] . '</option>';
}
echo '</select>';
    ?>
    <input type="submit" name="addDestination" value="Ajouter">
    </form>
</body>

</html>