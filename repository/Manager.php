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

        //insertion des messages utilisateur (review)
        public function createReview(Review $review)
        {
            $req = $this->db->prepare('INSERT INTO review (message, author, tour_operator_id) VALUE (:message, :author, :tour_operator_id)');


            $req->execute([
                'message' => $review->getMessage(),
                'author' => $review->getAuthor(),
                'tour_operator_id' => $review->getTour_operator_id(),
            
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

    // Récupérez les résultats sous forme d'un tableau d'objets Review
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
    $result = $this->db->query($query);
    $tourOperatorsData = $result->fetchAll();
    $tourOperators = [];

    foreach ($tourOperatorsData as $tourOperator) {
        $tourOperators[] = new TourOperateur($tourOperator);
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
    $query = 'SELECT * FROM tour_operator WHERE id IN (SELECT tour_operator_id FROM destination WHERE id = :destinationId)';
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


public function updateOperatorToPremium(TourOperateur $operatorId)
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
      
        $query = "INSERT INTO tour_operator (name, link, grade_count, grade_total, is_premium) 
                  VALUES (:name, :link, :grade_count, :grade_total, :is_premium)";
    
        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':name', $tourOperateur->getName());
        $stmt->bindValue(':link', $tourOperateur->getLink());
        $stmt->bindValue(':grade_count', $tourOperateur->getGrade_count());
        $stmt->bindValue(':grade_total', $tourOperateur->getGrade_total());
        $stmt->bindValue(':is_premium', $tourOperateur->getIs_premium());

        $stmt->execute();
        return $this->db->lastInsertId();
    } 
    catch (PDOException $e) {
        
        echo 'Erreur : ' . $e->getMessage();
        return false; // Ou tout autre traitement d'erreur que vous préférez
    }
}

public function createDestination(Destination $destination)
{
    try {
        $query = "INSERT INTO destination (location, price, tour_operator_id, image) 
                      VALUES (:location, :price, :tour_operator_id, :image)";

        $stmt = $this->db->prepare($query);

        $stmt->bindValue(':location', $destination->getLocation());
        $stmt->bindValue(':price', $destination->getPrice());
        $stmt->bindValue(':tour_operator_id', $destination->getTour_operator_id());
        $stmt->bindValue(':image', $destination->getImage());


        $uploadedFile = $_FILES['image'];
        if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
           
            $uploadDir = 'uploads/'; 
            $uploadPath = $uploadDir . basename($uploadedFile['name']);
    
            
            move_uploaded_file($uploadedFile['tmp_name'], $uploadPath);
    
          
            $destination->setImage($uploadPath);
        }

        $stmt->execute();

       
        $destination = $this->db->lastInsertId();
        return $destination;
    } catch (PDOException $e) {
     
        echo 'Erreur : ' . $e->getMessage();
        return false;
    }
}

public function getAllDestinations()
{
    $query = 'SELECT * FROM destination';
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

}