<?php

Class TourOperateur 
{
    private int $id;
    private string $name;
    private string $link;
    private int $grade_count;
    private int $grade_total;
    private bool $is_premium;

    public function __construct(array $data){
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
                $this->setGrade_count($datas["grade_count"]);
            }
            if(isset($datas["grade_total"]))
            {
                $this->setGrade_total($datas["grade_total"]);
            }
            if(isset($datas["is_premium"]))
            {
                $this->setIs_premium($datas["is_premium"]);
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
     * Get the value of grade_count
     */ 
    public function getGrade_count()
    {
        return $this->grade_count;
    }

    /**
     * Set the value of grade_count
     *
     * @return  self
     */ 
    public function setGrade_count($grade_count)
    {
        $this->grade_count = $grade_count;

        return $this;
    }

    /**
     * Get the value of grade_total
     */ 
    public function getGrade_total()
    {
        return $this->grade_total;
    }

    /**
     * Set the value of grade_total
     *
     * @return  self
     */ 
    public function setGrade_total($grade_total)
    {
        $this->grade_total = $grade_total;

        return $this;
    }

    /**
     * Get the value of is_premium
     */ 
    public function getIs_premium()
    {
        return $this->is_premium;
    }

    /**
     * Set the value of is_premium
     *
     * @return  self
     */ 
    public function setIs_premium($is_premium)
    {
        $this->is_premium = $is_premium;

        return $this;
    }
}

?>