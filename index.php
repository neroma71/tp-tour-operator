<?php
require_once("./utils/db_connect.php");
require_once("./utils/loadClass.php");
require_once('./entity/Destination.php');

$manager = new TourOperateurRepository($bdd);

$destinations = $manager->getAllDestinations();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Destinations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php

include('./partiel/header.php')

    ?>
    <section>
        <div class="row justify-content-center affichage">
            <?php foreach ($destinations as $destination): ?>
                <a href="liste.php?location=<?php echo $destination->getLocation(); ?>" class="col-3 m-3" style="background:url('<?php echo $destination->getImage(); ?>') top center no-repeat; background-size:cover;">
                <img src="<?php echo $destination->getImage(); ?>">    
                <p class="dest">Destination : <?php echo $destination->getLocation(); ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>
