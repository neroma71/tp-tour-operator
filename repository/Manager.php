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

    }