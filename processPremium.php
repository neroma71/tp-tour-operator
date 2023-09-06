<?php
    require_once './Utils/db_connect.php';
    require_once './Utils/loadClass.php';


    if (isset($_POST['updateOperator'])) {
        $tourOperatorId = $_POST['tour_operator_id'];
        $isPremium = $_POST['is_premium'];
    
        try {
            // Mettez à jour le tour-opérateur avec le statut premium en fonction de l'ID
            $sql = "UPDATE tour_operator SET is_premium = :is_premium WHERE id = :id";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':is_premium', $isPremium, PDO::PARAM_INT);
            $stmt->bindParam(':id', $tourOperatorId, PDO::PARAM_INT);
            $stmt->execute();
            
            echo "Le statut premium du tour-opérateur a été mis à jour avec succès.";
            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>