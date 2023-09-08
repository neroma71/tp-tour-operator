<?php
require_once("./utils/connexion.php"); 
require_once("./utils/loadClass.php"); 

$manager = new Manager($bdd);

if (
    !empty($_POST['name']) &&
    !empty($_POST['grade_count']) &&
    !empty($_POST['grade_total']) &&
    isset($_POST['is_premium']) &&
    isset($_POST['link']) &&
    !empty($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK
) {

    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      
        $imagePath = $uploadFile;  

    $name = $_POST['name'];
    $gradeCount = $_POST['grade_count'];
    $gradeTotal = $_POST['grade_total'];
    $isPremium = $_POST['is_premium'];
    $link = $_POST['link'];
    $image = $_FILES['image'];

    $tourOpData = [
        'name' => $_POST['name'],
        'grade_count' => $_POST['grade_count'],
        'grade_total' => $_POST['grade_total'],
        'is_premium' => $_POST['is_premium'],
        'link' => $_POST['link'],
        'image' => $imagePath 
    ];

    $tourOps = new TourOperateur($tourOpData);

    $manager->createTourOperator($tourOps);
    header('location: http://localhost/tp-tour-operator/admin.php');
 } else{
        echo "Erreur lors du téléchargement de l'image.";
    } 
}
///////////formulaire location////////////
if (
    !empty($_POST['location']) &&
    !empty($_POST['price']) &&
    !empty($_POST['tour_operator_id']) &&
    !empty($_FILES['image']) &&
    $_FILES['image']['error'] === UPLOAD_ERR_OK
) {
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        // Vous pouvez enregistrer le chemin du fichier image dans votre objet Destination
        $imagePath = $uploadFile;

        $location = $_POST['location'];
        $price = $_POST['price'];
        $tour_operator_id = $_POST['tour_operator_id'];

        $destinationData = [
            'location' => $_POST['location'],
            'price' => $_POST['price'],
            'tour_operator_id' => $_POST['tour_operator_id'],
            'image' => $imagePath  // Utilisez le chemin du fichier image ici
        ];

        $destination = new Destination($destinationData);
        $manager->createDestination($destination);
        header('location: http://localhost/tp-tour-operator/admin.php');
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
