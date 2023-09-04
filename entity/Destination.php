<?php

include_once('./connect/connect.php');
class Destination {

    private $id;
    private $location;
    private $price;
    private $tour_operator_id;
    private $bdd;

    public function __construct($bdd)
    {
     $this->bdd =$bdd;
    }

    public function getDestinationById($tour_operator_id) {
        $query = "SELECT * FROM destinations WHERE id = :$tour_operator_id";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':id', $tour_operator_id);
        $stmt->execute();
        $bddData = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->hydrate($bddData);

        
    }

      /* au lieu on fait la hydrate 
      $this->id = $row['id'];
        $this->location = $row['location'];
        $this->price = $row['price'];
        $this->tourOperatorId = $row['tourOperatorId'];
        */

    public function Hydrate($bdd){
        if (isset($bdd['id'])){
            $this->id = $bdd['id'];
        }
        if (isset($bdd['location'])){
            $this->id = $bdd['location'];
        }
        if (isset($bdd['price'])){
            $this->id = $bdd['price'];
        }
        if (isset($bdd['tour_operator_id'])){
            $this->id = $bdd['tour_operator_id'];
        }
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of location
     */ 
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */ 
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of tour_operator_id
     */ 
    public function getTour_operator_id()
    {
        return $this->tour_operator_id;
    }

    /**
     * Set the value of tour_operator_id
     *
     * @return  self
     */ 
    public function setTour_operator_id($tour_operator_id)
    {
        $this->tour_operator_id = $tour_operator_id;

        return $this;
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

$destination = new Destination($bdd);
$destination->getDestinationById(2);
$destination->hydrate($bddData);

echo ($bddData);

?>