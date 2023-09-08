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

    // Récupérer 
    $name = $_POST['name'];
    $link = $_POST['link'];
    $is_premium = isset($_POST['is_premium']) ? 1 : 0;
    $gradeCount = $_POST['grade_count']; 
$gradeTotal = $_POST['grade_total'];
    $uploadedFile = $_FILES['image'];


    $tourOperateur = new TourOperateur([
        'name' => $name,
        'link' => $link,
        'is_premium' => $is_premium,
        'grade_count' => $gradeCount,
    'grade_total' => $gradeTotal,
        'image' => $uploadedFile['name']
    ]);

    $tourOperateurRepository = new TourOperateurRepository($bdd);

    $insertedId = $tourOperateurRepository->createTourOperator($tourOperateur);

    if ($insertedId !== false) {
        echo "L'opérateur a été créé avec l'identifiant $insertedId.";
    } else {
        echo "Une erreur s'est produite lors de la création de l'opérateur.";
    }

    header("Location: ./admin.php");

    ?>
</body>

</html>