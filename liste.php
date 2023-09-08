<?php
require_once("./utils/loadClass.php");
require_once("./utils/connexion.php");

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
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1>Comparo.FR</h1>
        </header>
        <div class="container-fluid">
            <div class="bg"></div>
        <?php
        if ($destinations) {
            echo '<section class="blockaffichage">';
            echo '<div class="row text-center titre">';
            echo '<h2>destination : ' . $destinations[0]->getLocation() . '</h2>';
            echo '<h3>Liste des Tours Opérateurs :</h3>';
            echo '</div>';
            echo '<div class="row d-flex justify-content-center affichage">';
        } else {
            echo '<p>Destination non trouvée.</p>';
        }
    } else {
        echo '<p>Destination non valide.</p>';
    }
    foreach ($destinations as $destination) {
        $tourOperator = $manager->getTourOperatorById($destination->getTour_operator_id());
        echo '<a href="tourop.php?id=' . $tourOperator->getId() . '" style="background:url(' . $tourOperator->getImage() . ')" class="col-3">';
        echo '<p>' . $tourOperator->getName() . '</p>';
        echo '<p>mail : ' . $tourOperator->getLink() . '</p>';
        echo '</a>';
    }
    echo '</div>';
    echo '</section>';
        ?>
        </div>
        <footer>dsfdf</footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
    <script>
        let bg = document.querySelector('.bg');
        window.addEventListener('scroll', () => {
            bg.style.backgroundPositionY = window.scrollY / 1.5 + 'px';
        });
    </script>
    </html>