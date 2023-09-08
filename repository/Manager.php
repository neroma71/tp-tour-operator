<?php

class Manager
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }
    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }


    public function createReview(Review $review, TourOperateur $tourOperator)
    {
        $req = $this->db->prepare('INSERT INTO review (message, author, tour_operator_id) VALUE (:message, :author, :tour_operator_id)');

        $req->execute([
            'message' => $review->getMessage(),
            'author' => $review->getAuthor(),
            'tour_operator_id' => $review->getTour_operator_id(),
        ]);


        $req = $this->db->prepare('UPDATE tour_operator SET grade_count = :grade_count, grade_total = :grade_total WHERE id = :id');
        $req->execute([
            'grade_count' => $tourOperator->getGrade_count(),
            'grade_total' => $tourOperator->getGrade_total(),
            'id' => $tourOperator->getId(),
        ]);

        $review = $this->db->lastInsertId();
        return $review;
    }

    public function getReviewsByTourOperatorId(int $tourOperatorId)
    {
        $sql = 'SELECT * FROM review WHERE tour_operator_id = :tour_operator_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':tour_operator_id', $tourOperatorId, PDO::PARAM_INT);
        $stmt->execute();


        $reviews = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $review = new Review($row);
            $reviews[] = $review;
        }

        return $reviews;
    }

    public function getAllOperator()
    {
        $query = 'SELECT * FROM tour_operator';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $tourOperatorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tourOperators = [];

        foreach ($tourOperatorsData as $tourOperatorData) {
            $tourOperators[] = new TourOperateur($tourOperatorData);
        }

        return $tourOperators;
    }

    public function getTourOperatorById($operatorId)
    {
        $query = 'SELECT * FROM tour_operator WHERE id = :operatorId';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':operatorId', $operatorId, PDO::PARAM_INT);
        $stmt->execute();

        $tourOperatorData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tourOperatorData) {
            return new TourOperateur($tourOperatorData);
        } else {
            return null; // L'opérateur de tour avec cet ID n'a pas été trouvé
        }
    }

    public function getTourOperatorsByDestinationId($destinationId)
    {
        $query = 'SELECT * FROM tour_operator WHERE id = :destinationId';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
        $stmt->execute();

        $tourOperatorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $tourOperators = [];

        foreach ($tourOperatorsData as $tourOperatorData) {
            $tourOperators[] = new TourOperateur($tourOperatorData);
        }

        return $tourOperators;
    }

    public function updateOperatorToPremium(TourOperateur $operator)
    {
        $query = 'UPDATE tour_operator SET is_premium = 1 WHERE id = :operatorId';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':operatorId', $operatorId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function createTourOperator(TourOperateur $tourOperateur)
    {
        try {
            // Préparez une requête SQL pour insérer un nouvel enregistrement dans la table tour_operator
            $query = "INSERT INTO tour_operator (name, link, grade_count, grade_total, is_premium, image) 
                      VALUES (:name, :link, :grade_count, :grade_total, :is_premium, :img)";

            $uploadedFile = $_FILES['image'];
            if ($uploadedFile['error'] === UPLOAD_ERR_OK) {

                // Définir le chemin où enregistrer le fichier
                $uploadDir = 'uploads/'; // Répertoire où vous souhaitez stocker les images
                $uploadPath = $uploadDir . basename($uploadedFile['name']);

                // Déplacer le fichier vers le répertoire d'upload
                move_uploaded_file($uploadedFile['tmp_name'], $uploadPath);

                // Enregistrement du chemin dans la base de données
                $tourOperateur->setImage($uploadPath);
            }
            // Utilisez PDO pour préparer la requête
            $stmt = $this->db->prepare($query);

            // Associez les valeurs des propriétés de l'objet TourOperateur aux paramètres de la requête
            $stmt->bindValue(':name', $tourOperateur->getName());
            $stmt->bindValue(':link', $tourOperateur->getLink());
            $stmt->bindValue(':grade_count', $tourOperateur->getGrade_Count());
            $stmt->bindValue(':grade_total', $tourOperateur->getGrade_Total());
            $stmt->bindValue(':is_premium', $tourOperateur->getIs_Premium());
            $stmt->bindValue(':img', $tourOperateur->getImage());

            // Exécutez la requête pour insérer l'enregistrement dans la base de données
            $stmt->execute();

            // Vous pouvez gérer les succès ou les erreurs ici
            // Par exemple, retourner l'identifiant de l'enregistrement inséré
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Gestion des erreurs
            // Vous pouvez enregistrer l'erreur dans un journal, afficher un message d'erreur, etc.
            echo 'Erreur : ' . $e->getMessage();
            return false; // Ou tout autre traitement d'erreur que vous préférez
        }
    }

    public function createDestination(Destination $destination)
    {
        try {
            // Préparez une requête SQL pour insérer un nouvel enregistrement dans la table tour_operator
            $query = "INSERT INTO destination (location, price, tour_operator_id, image) 
                          VALUES (:location, :price, :tour_operator_id, :image)";
            $uploadedFile = $_FILES['image'];
            if ($uploadedFile['error'] === UPLOAD_ERR_OK) {

                // Définir le chemin où enregistrer le fichier
                $uploadDir = 'uploads/'; // Répertoire où vous souhaitez stocker les images
                $uploadPath = $uploadDir . basename($uploadedFile['name']);

                // Déplacer le fichier vers le répertoire d'upload
                move_uploaded_file($uploadedFile['tmp_name'], $uploadPath);

                // Enregistrement du chemin dans la base de données
                $destination->setImage($uploadPath);
            }
            // Utilisez PDO pour préparer la requête
            $stmt = $this->db->prepare($query);

            // Associez les valeurs des propriétés de l'objet TourOperateur aux paramètres de la requête
            $stmt->bindValue(':location', $destination->getLocation());
            $stmt->bindValue(':price', $destination->getPrice());
            $stmt->bindValue(':tour_operator_id', $destination->getTour_operator_id());
            $stmt->bindValue(':image', $destination->getImage());

            // Exécutez la requête pour insérer l'enregistrement dans la base de données
            $stmt->execute();

            // Vous pouvez gérer les succès ou les erreurs ici
            // Par exemple, retourner l'identifiant de l'enregistrement inséré
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Gestion des erreurs
            // Vous pouvez enregistrer l'erreur dans un journal, afficher un message d'erreur, etc.
            echo 'Erreur : ' . $e->getMessage();
            return false; // Ou tout autre traitement d'erreur que vous préférez
        }
    }

    public function getAllDestinations()
    {
        $query = 'SELECT * FROM destination GROUP BY location';
        $stmt = $this->db->query($query);
        $destinationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $destinations = [];

        foreach ($destinationsData as $destinationData) {
            $destination = new Destination($destinationData);
            $destinations[] = $destination;
        }

        return $destinations;
    }

    public function getDestinationById($destinationId)
    {
        $query = 'SELECT * FROM destination WHERE id = :destinationId';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
        $stmt->execute();

        $destinationData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($destinationData) {
            return new Destination($destinationData);
        } else {
            return null; // La destination avec cet ID n'a pas été trouvée
        }
    }

    public function getDestinationByLocation($destinationLocation)
    {
        $query = 'SELECT * FROM destination WHERE location = :location';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':location', $destinationLocation, PDO::PARAM_STR);
        $stmt->execute();

        $destinationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $destinations = [];

        if ($destinationsData) {
            foreach ($destinationsData as $destinationData) {
                $destinations[] = new Destination($destinationData);
            }
            return $destinations;
        } else {
            return null;
        }
    }

    public function getDestinationsByTourOperatorId($tourOperatorId)
    {
        $query = 'SELECT * FROM destination WHERE tour_operator_id  = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $tourOperatorId, PDO::PARAM_STR);
        $stmt->execute();

        $destinationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $destinations = [];

        if ($destinationsData) {
            foreach ($destinationsData as $destinationData) {
                $destinations[] = new Destination($destinationData);
            }
            return $destinations;
        } else {
            return null;
        }
    }

    public function getPremiumTourOperators()
    {
        $query = 'SELECT * FROM tour_operator WHERE is_premium = 1';
        $stmt = $this->db->query($query);
        $premiumOperatorsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $premiumOperators = [];

        foreach ($premiumOperatorsData as $premiumOperatorData) {
            $premiumOperators[] = new TourOperateur($premiumOperatorData);
        }

        return $premiumOperators;
    }

    public function updatePremium(TourOperateur $operator)
    {
        $query = 'UPDATE tour_operator SET is_premium = :isPremium WHERE id = :operatorId';

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':isPremium' => $operator->getIs_premium(),
                ':operatorId' => $operator->getId()
            ]);
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function getTourOperatorNameAndId()
    {

        $sql = "SELECT id, name FROM tour_operator";
        $result = $this->db->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    }

    public function getOperatorByDestination()
    {
        $query = 'SELECT "location" FROM destination';
        $result = $this->db->query($query);
        $locationsData = $result->fetchAll();
        $locations = [];

        foreach ($locationsData as $location) {
            $locations[] = new Destination($location);
        }

        return $locations;
    }

    public function isPremium()
    {
        $sql = "UPDATE tour_operator SET is_premium = :is_premium WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':is_premium', $isPremium, PDO::PARAM_INT);
        $stmt->bindParam(':id', $tourOperatorId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Le statut premium du tour-opérateur a été mis à jour avec succès.";
    }

    public function IdFromTourOperator($id)
    {
        $sql = "SELECT * FROM tour_operator WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si une ligne a été trouvée avant de retourner l'identifiant
        if ($row) {
            return $row['id'];
        } else {
            return null; // ou une valeur par défaut appropriée
        }
    }
}
