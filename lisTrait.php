<?php
    require_once("./utils/db_connect.php"); 
    require_once("./utils/loadClass.php");

$manager = new TourOperateurRepository($bdd);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $tour_operator_id = $_GET['id'];
} 

$Destination = $manager->getTourOperatorById($tour_operator_id);

if (isset($_POST['author']) && !empty($_POST['author']) && isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['tour_operator_id']) && !empty($_POST['tour_operator_id'])){
    $author = $_POST['author'];
    $message = $_POST['message'];
    $tour_operator_id = $_POST['tour_operator_id'];
    $grade_count = $_POST['grade_count'];
    $grade_total = $_POST['grade_total'];


    $reviewData = [
        'author' => $_POST['author'],
        'message' => $_POST['message'],
        'tour_operator_id' => $_POST['tour_operator_id'],
       
    ];
    
    $review = new Review($reviewData);


    $manager->createReview($review);   

    //metre a jour les grate
    $tourOperator->setGradeCount($tourOperator->getGradeCount() + 1); 
    $tourOperator->setGradeTotal($tourOperator->getGradeTotal() + $_POST['grade_total']); 

    $manager->updateTourOperatorGrade($tourOperator);
}
$tourOperatorId = $_POST['tour_operator_id'];
$tourOperator = $manager->getReviewsByTourOperatorId($tourOperatorId);

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