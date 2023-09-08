<?php

require_once("./utils/loadClass.php");
require_once("./utils/connexion.php");

$manager = new Manager($bdd);
// $tourOperatorData = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $tourOperatorId = $_GET['id'];
} else {
}

$tourOperator = $manager->getTourOperatorById($tourOperatorId);

if (isset($_POST['author']) && !empty($_POST['author']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['tour_operator_id']) && !empty($_POST['tour_operator_id']) && isset($_POST['grade_total'])) {

    $author = $_POST['author'];
    $message = $_POST['message'];
    $tour_operator_id = $_POST['tour_operator_id'];
    $grade_total = $_POST['grade_total'];



    if (!empty($_POST['grade_total'])) {

        $tourOperator->setGrade_count($tourOperator->getGrade_count() + 1);
        $tourOperator->setGrade_total($tourOperator->getGrade_total() + $grade_total);


        $review = new Review([
            'author' => $author,
            'message' => $message,
            'tour_operator_id' => $tour_operator_id,
        ]);


        $manager->createReview($review, $tourOperator);
    } else {
        echo "TourOperator non trouvé.";
    }
}

$reviews = $manager->getReviewsByTourOperatorId($tourOperatorId);
$tourOperator = $manager->getTourOperatorById($tourOperatorId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/tourop.css">
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1>Comparo.FR</h1>
    </header>
    <section class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-12 bg">

            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-12 text-center agence">
                <?php
                if ($tourOperator) {
                    $destinations = $manager->getDestinationsByTourOperatorId($tourOperator->getId());
                    echo '<h2>Agence : ' . $tourOperator->getName() . '</h2>';
                    echo '<p><a href"mailto:' . $tourOperator->getLink() . '"> Site :' . $tourOperator->getLink() . '</a></p>';
                    echo '<p> Nombre de note : ' . $tourOperator->getGrade_count() . '</p>';
                    echo '<p> Note totale : ' . $tourOperator->getGrade_total() . '</p>';
                    echo '<div class="logo" style="background:url(' . $tourOperator->getImage() . ')top center no-repeat; background-size:contain;"></div>';
                }
                ?>
            </div>
            <div class="col-12 col-md-7 mb-5 content">
                <?php foreach ($destinations as $destination) : ?>
                    <div class="destination" style="background:url('<?php echo $destination->getImage(); ?>')top center no-repeat; background-size:cover;">
                        <h4>Destination : <?php echo $destination->getLocation(); ?></h4>
                        <p>Prix : <?php echo $destination->getPrice(); ?> €</p>;
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-12 col-md-3 messagerie">
                <div class="msg">
                    <?php foreach ($reviews as $review) : ?>
                        <p>Auteur : <?php echo $review->getAuthor(); ?></p>
                        <p>Message : <?php echo $review->getMessage(); ?></p>
                    <?php endforeach; ?>
                </div>
                <form method="post" action="">
                    <p>
                        <input type="text" name="author" placeholder="rentrer votre nom">
                    </p>
                    <p>
                        <input type="text" name="message" placeholder="taper votre message ici" id="mymsg">
                    </p>
                    <input type="hidden" name="tour_operator_id" value="<?php echo $tourOperatorId; ?>">
                    <p>
                        <label>attribuer une notre</label><br />
                        <input type="number" name="grade_total" min="0" max="5">
                    </p>
                    <p>
                        <input type="submit" value="envoyer" />
                    </p>
                </form>
            </div>
        </div>
    </section>

    <script>
        let bg = document.querySelector('.bg');
        window.addEventListener('scroll', () => {
            bg.style.backgroundPositionY = window.scrollY / 1.5 + 'px';
        });
    </script>
</body>

</html>