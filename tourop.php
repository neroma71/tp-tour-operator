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
        'author' => $author,
        'message' => $message,
        'tour_operator_id' => $tour_operator_id
    ];
    
    $review = new Review($reviewData);

    if ($_POST['author'] === 'author') {
        $review = new Review($reviewData);
    } elseif ($_POST['message'] === 'message') {
        $review = new Review($reviewData);
    } elseif ($_POST['tour_operator_id'] === 'tour_operator_id') {
        $review = new Review($reviewData);
    }

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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form method="post" action="">
    <label>auteur</label>
        <input type="text" name="author">
        <label>message</label>
        <input type="text" name="message">
        <input type="hidden" name="tour_operator_id" value="3">
        <input type="submit" value ="envoyer" />
    </form>
    <ul>
        <?php foreach ($reviews as $review) : ?>
            <li>
                <strong>Auteur:</strong> <?php echo $review->getAuthor(); ?><br>
                <strong>Message:</strong> <?php echo $review->getMessage(); ?><br>
                <hr>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>