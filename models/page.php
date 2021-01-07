<?php

Class page{
    //DB Stuff
    private $conn;
    private $table = 'spage';

    //Service Properties
    public $serviceID;
    public $pageID;
    public $pageTitle;
    public $metaTag;
    
    //Constructor with db
    public function __construct($db){
        $this->conn = $db;
    }
    
     public function create_page(){
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            serviceID = :serviceID,
            pageTitle = :pageTitle,
            metaTag = :metaTag';

            //Preparing statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->serviceID =htmlspecialchars(strip_tags($this->serviceID));
            $this->pageTitle =htmlspecialchars(strip_tags($this->pageTitle));
            $this->metaTag =htmlspecialchars(strip_tags($this->metaTag));

            //Bind data
            $stmt->bindParam(':serviceID', $this->serviceID);
            $stmt->bindParam(':pageTitle', $this->pageTitle);
            $stmt->bindParam(':metaTag', $this->metaTag);

            //Executing query
            if($stmt->execute()){
                return true;
            }
        }

        public function read_page_service()
        {
            //Create query
            $query = 'SELECT * FROM '. $this->table.' WHERE serviceID = :serviceID';
        //Preparing statement
        $stmt = $this->conn->prepare($query);
            //Clean data
            $this->serviceID =htmlspecialchars(strip_tags($this->serviceID));

            //Bind data
            $stmt->bindParam(':serviceID', $this->serviceID);
        //Executing query
        $stmt->execute();

        return $stmt;
        }

	  //Update Page
         public function update_page(){
            //Update query
            $query = 'UPDATE ' . $this->table . '
            SET
                serviceID = :serviceID,
                pageTitle = :pageTitle,
                metaTag = :metaTag
            WHERE
                pageID = :pageID';
    
                //Preparing statement
                $stmt = $this->conn->prepare($query);
    
                //Clean data
                $this->serviceID =htmlspecialchars(strip_tags($this->serviceID));
                $this->metaTag =htmlspecialchars(strip_tags($this->metaTag));
                $this->pageTitle =htmlspecialchars(strip_tags($this->pageTitle));
                $this->pageID =htmlspecialchars(strip_tags($this->pageID));
                //Bind data
                $stmt->bindParam(':metaTag', $this->metaTag);
                $stmt->bindParam(':serviceID', $this->serviceID);
                $stmt->bindParam(':pageTitle', $this->pageTitle);
                $stmt->bindParam(':pageID', $this->pageID);

                //Executing query
                if($stmt->execute()){
                    return true;
                }
    
                //Print error
                printf("Error: %s.\n", $stmt->error);
                return false;
        }

        
        public function delete_page(){
            //Creating query
            $query = 'DELETE FROM '. $this->table .'
            WHERE pageID = :pageID';

            //Preparing statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->pageID =htmlspecialchars(strip_tags($this->pageID));

            //Bind data
            $stmt->bindParam(':pageID', $this->pageID);

            //Executing query
            if($stmt->execute()){
                return true;
            }
            
            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }


    }