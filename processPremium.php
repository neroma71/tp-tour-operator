<?php
    require_once './Utils/db_connect.php';
    require_once './Utils/loadClass.php';


    if (isset($_POST['updateOperator'])) {
        $tourOperatorId = $_POST['tour_operator_id'];
        $isPremium = $_POST['is_premium'];
    
        try {
            // Mettez à jour le tour-opérateur avec le statut premium en fonction de l'ID
            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>