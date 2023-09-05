<?php
    class Destination 
    {
    private $id;
    private $location;
    private $price;
    private $tour_operator_id;
    private $image;

    public function __construct(array $datas)
        {
            $this->hydrate($datas);
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
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function hydrate(array $datas)
    {
        if(isset($datas["id"]))
        {
            $this->setId($datas["id"]);
        }
        if(isset($datas["location"]))
        {
            $this->setLocation($datas["location"]);
        }
        if (isset($datas["price"])) {
            $this->setPrice($datas["price"]);
        }
        if(isset($datas["tour_operator_id"]))
        {
            $this->setTour_operator_id($datas["tour_operator_id"]);
        }
        if(isset($datas["image"]))
        {
            $this->setImage($datas["image"]);
        }
     
    }
}

?>