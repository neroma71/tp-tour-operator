<?php
include_once('./connect/connect.php');
include_once('./admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['addTourOperator'])) {
        $name = $_POST['Name'];
        $grade_Count = $_POST['grade_Count'];
        $grade_total = $_POST['grade_total'];
        $is_premium = $_POST['is_premium'];
        $link = isset($_POST['link']) ? $_POST['link'] : null;

        $query = "INSERT INTO `tour_operator`(`name`, `link`, `grade_count`, `grade_total`, `is_premium`) VALUES (:name, :link, :gradeCount, :gradeTotal, :isPremium)";
        $stmt = $bdd->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':gradeCount', $gradeCount);
        $stmt->bindParam(':gradeTotal', $gradeTotal);
        $stmt->bindParam(':is_premium', $is_premium);

        $stmt->execute();

        echo "Ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout";
    }
}
