<?php
require_once("./utils/connexion.php"); 
require_once("./utils/autoload.php"); 

$manager = new Manager($bdd);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $tourOperatorId = $_GET['id'];
   
} else {
    
}

$tourOperator = $manager->getTourOperatorById($tourOperatorId);




if(isset($_POST['author']) && !empty($_POST['author']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['tour_operator_id']) && !empty($_POST['tour_operator_id']))
{
    $author = $_POST['author'];
    $message = $_POST['message'];
    $tour_operator_id = $_POST['tour_operator_id'];

    $reviewData = [
        'author' => $_POST['author'],
        'message' => $_POST['message'],
        'tour_operator_id' => $_POST['tour_operator_id']
    ];
    
    $review = new Review($reviewData);

    $manager->createReview($review);   
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
            <h1>Comparo.FR</h1>
        </header>
    <?php
    if ($tourOperator) {
        $destinations = $manager->getDestinationsByTourOperatorId($tourOperator->getId());
        

        echo '<h2>' . $tourOperator->getName() . '</h2>';
        echo '<p>' . $tourOperator->getLink() . '</p>';
        echo '<p>' . $tourOperator->getGrade_count() . '</p>';
        echo '<p>' . $tourOperator->getGrade_total() . '</p>';
        echo '<p>' . $tourOperator->getIs_premium() . '</p>';  
    }
    ?>
<div class="content">
    <?php foreach($destinations as $destination): ?>
        <div class="destination" style="background:url('<?php echo $destination->getImage(); ?>')top center no-repeat; background-size:cover;">
            <h4>Destination : <?php echo $destination->getLocation(); ?></h4>
            <p>Prix : <?php echo $destination->getPrice(); ?> €</p>;
        </div>
    <?php endforeach; ?>
</div>
<section class="messagerie">
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
            <input type="submit" value ="envoyer" />
        </p>
    </form>
</section>
</body>
</html>
