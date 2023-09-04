<?php

class TourOperateurRepository
{

    private PDO $bdd;

    public function __construct(PDO $bdd)
    {
        $this->setbdd($bdd);
    }

    public function getAllDestination()
    {
        $query = 'SELECT * FROM destination';
        $result = $this->bdd->query($query);
        $destinationsData = $result->fetchAll();
        $destinations = [];

        foreach ($destinationsData as $destination) {
            $destinations[] = new Destination($destination);
        }

        return $destinations;
    }


    public function getOperatorByDestination()
    {
        $query = 'SELECT "location" FROM destination';
        $result = $this->bdd->query($query);
        $locationsData = $result->fetchAll();
        $locations = [];

        foreach ($locationsData as $location) {
            $locations[] = new Destination($location);
        }

        return $locations;
    }

    public function createReview()
    {
    }

    public function getReviewByOperaroId()
    {
    }

    public function getAllOperator()
    {
        $query = 'SELECT * FROM tour_operator';
        $result = $this->bdd->query($query);
        $tourOperatorsData = $result->fetchAll();
        $tourOperators = [];

        foreach ($tourOperatorsData as $tourOperator) {
            $tourOperators[] = new TourOperateur($tourOperator);
        }

        return $tourOperators;
    }

    public function updateOperatorToPremium($operatorId)
    {
        $query = 'UPDATE tour_operateur SET is_premium = 1 WHERE id = :operatorId';

        try {
            $stmt = $this->bdd->prepare($query);
            $stmt->bindParam(':operatorId', $operatorId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    public function createTourOperator(TourOperateur $tourOperateur)
    {
        try {
            // Préparez une requête SQL pour insérer un nouvel enregistrement dans la table tour_operateur
            $query = "INSERT INTO tour_operateur (name, link, grade_count, grade_total, is_premium) 
                      VALUES (:name, :link, :grade_count, :grade_total, :is_premium)";

            // Utilisez PDO pour préparer la requête
            $stmt = $this->bdd->prepare($query);

            // Associez les valeurs des propriétés de l'objet TourOperateur aux paramètres de la requête
            $stmt->bindValue(':name', $tourOperateur->getName());
            $stmt->bindValue(':link', $tourOperateur->getLink());
            $stmt->bindValue(':grade_count', $tourOperateur->getGradeCount());
            $stmt->bindValue(':grade_total', $tourOperateur->getGradeTotal());
            $stmt->bindValue(':is_premium', $tourOperateur->getIsPremium());

            // Exécutez la requête pour insérer l'enregistrement dans la base de données
            $stmt->execute();

            // Vous pouvez gérer les succès ou les erreurs ici
            // Par exemple, retourner l'identifiant de l'enregistrement inséré
            return $this->bdd->lastInsertId();
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
            // Préparez une requête SQL pour insérer un nouvel enregistrement dans la table tour_operateur
            $query = "INSERT INTO tour_operateur (location, price, tour_operator_id) 
                          VALUES (:location, :price, :tour_operator_id)";

            // Utilisez PDO pour préparer la requête
            $stmt = $this->bdd->prepare($query);

            // Associez les valeurs des propriétés de l'objet TourOperateur aux paramètres de la requête
            $stmt->bindValue(':location', $destination->getName());
            $stmt->bindValue(':price', $destination->getLink());
            $stmt->bindValue(':tour_operator_id', $destination->getGradeCount());

            // Exécutez la requête pour insérer l'enregistrement dans la base de données
            $stmt->execute();

            // Vous pouvez gérer les succès ou les erreurs ici
            // Par exemple, retourner l'identifiant de l'enregistrement inséré
            return $this->bdd->lastInsertId();
        } catch (PDOException $e) {
            // Gestion des erreurs
            // Vous pouvez enregistrer l'erreur dans un journal, afficher un message d'erreur, etc.
            echo 'Erreur : ' . $e->getMessage();
            return false; // Ou tout autre traitement d'erreur que vous préférez
        }
    }

    /**
     * Get the value of bdd
     */
    public function getBdd()
    {
        return $this->bdd;
    }

    /**
     * Set the value of bdd
     *
     * @return  self
     */
    public function setBdd($bdd)
    {
        $this->bdd = $bdd;

        return $this;
    }
}
