<?php
require_once("./utils/connexion.php"); 
require_once("./utils/autoload.php"); 

$manager = new Manager($bdd);

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
$tourOperatorId = 3;
$reviews = $manager->getReviewsByTourOperatorId($tourOperatorId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/tourop.css">
</head>
<body>
<section class="messagerie">
    <div class="msg">
        <?php foreach ($reviews as $review) : ?>
            <p>Auteur : <?php echo $review->getAuthor(); ?></p>
            <p>Message : <?php echo $review->getMessage(); ?></p>
        </p>
        <?php endforeach; ?>
  </div>
    <form method="post" action="">
        <p>
            <input type="text" name="author" placeholder="rentrer votre nom">
        </p>
        <p>
            <input type="text" name="message" placeholder="taper votre message ici" id="mymsg">
        </p>
            <input type="hidden" name="tour_operator_id" value="3">
        <p>
            <input type="submit" value ="envoyer" />
        </p>
    </form>
</section>
</body>
</html>