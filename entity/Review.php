<?php
    class Review
    {
        private int $id;
        private string $message;
        private string $author;
        private int $tour_operator_id;

        public function __construct(array $datas)
        {
            $this->hydrate($datas);
        }
        

        /**
         * Get the value of tou_operator_id
         */ 
        public function getTour_operator_id()
        {
                return $this->tour_operator_id;
        }

        /**
         * Set the value of tou_operator_id
         *
         * @return  self
         */ 
        public function setTour_operator_id($tour_operator_id)
        {
                $this->tour_operator_id = $tour_operator_id;

                return $this;
        }

        /**
         * Get the value of author
         */ 
        public function getAuthor()
        {
                return $this->author;
        }

        /**
         * Set the value of author
         *
         * @return  self
         */ 
        public function setAuthor($author)
        {
                $this->author = $author;

                return $this;
        }

        /**
         * Get the value of message
         */ 
        public function getMessage()
        {
                return $this->message;
        }

        /**
         * Set the value of message
         *
         * @return  self
         */ 
        public function setMessage($message)
        {
                $this->message = $message;

                return $this;
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

        public function hydrate(array $datas)
        {
            if(isset($datas["id"]))
            {
                $this->setId($datas["id"]);
            }
            if(isset($datas["message"]))
            {
                $this->setMessage($datas["message"]);
            }
            if(isset($datas["tour_operator_id"]))
            {
                $this->setTour_operator_id($datas["tour_operator_id"]);
            }
         
        }
    }