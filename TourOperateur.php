<?php

Class TourOperateur {

    private $id;
    private $name;
    private $link;
    private $gradeCount;
    private $GradeTotal;
    private $isPremium;

    public function __construct($data){
        $this->hydrate($data);
    }

    public function hydrate(array $datas)
        {
            if(isset($datas["id"]))
            {
                $this->setid($datas["id"]);
            }
            if(isset($datas["name"]))
            {
                $this->setname($datas["name"]);
            }
            if(isset($datas["link"]))
            {
                $this->setlink($datas["link"]);
            }
            if(isset($datas["grade_count"]))
            {
                $this->setGradeCount($datas["grade_count"]);
            }
            if(isset($datas["grade_total"]))
            {
                $this->setGradeTotal($datas["grade_total"]);
            }
            if(isset($datas["is_premium"]))
            {
                $this->setisPremium($datas["is_premium"]);
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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of gradeCount
     */ 
    public function getGradeCount()
    {
        return $this->gradeCount;
    }

    /**
     * Set the value of gradeCount
     *
     * @return  self
     */ 
    public function setGradeCount($gradeCount)
    {
        $this->gradeCount = $gradeCount;

        return $this;
    }

    /**
     * Get the value of GradeTotal
     */ 
    public function getGradeTotal()
    {
        return $this->GradeTotal;
    }

    /**
     * Set the value of GradeTotal
     *
     * @return  self
     */ 
    public function setGradeTotal($GradeTotal)
    {
        $this->GradeTotal = $GradeTotal;

        return $this;
    }

    /**
     * Get the value of isPremium
     */ 
    public function getIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * Set the value of isPremium
     *
     * @return  self
     */ 
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;

        return $this;
    }
}

?>