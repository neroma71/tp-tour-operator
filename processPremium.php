<?php
    require_once './Utils/connexion.php';
    require_once './Utils/loadClass.php';
    

    if (isset($_POST['updateOperator'])) {

        $manager = new Manager($bdd);

        $tourOperatorId = $_POST['tour_operator_id'];
        $isPremium = $_POST['is_premium'];

        $tourOperator = $manager->getTourOperatorById($tourOperatorId);

        $tourOperator->setIs_premium($isPremium);

        $manager->updatePremium($tourOperator);
    
        try {
            // Mettez à jour le tour-opérateur avec le statut premium en fonction de l'ID
            header("Location: admin.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    ?>