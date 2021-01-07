<?php

Class Post{
    //DB Stuff
    private $conn;
    private $table = 'post';

    //Post Properties
    public $postID;
    public $pText;
    public $lastUpdate;
    public $postDate;
    public $imageURL;
    public $postTitle;
    public $pageID;
    public $username;
    public $serviceTitle;
    public $serviceDate;
    public $serviceType;

    //Constructor with db
    public function __construct($db){
        $this->conn = $db;
    }

    public function read_post(){
        //Create query
        $query = 'SELECT * FROM post, spage WHERE post.pageID = spage.pageID';
        //Preparing statement
        $stmt = $this->conn->prepare($query);
        //Executing query
        $stmt->execute();

        return $stmt;
    }

    //Get Single Post
    public function read_single_post(){
        $query = 'SELECT * FROM post, spage WHERE post.pageID = ? AND post.pageID = spage.pageID';
        //Preparing statement
        $stmt = $this->conn->prepare($query);

        //Binding pageID
        $stmt->bindParam(1, $this->pageID);

        //Executing query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Setting properties
        $this->postTitle = $row['postTitle'];
        $this->pText = $row['pText'];
        $this->postDate = $row['postDate'];
        $this->username = $row['username'];
        $this->serviceType = $row['serviceType'];
        $this->pageID = $row['pageID'];
    }

    public function read_page_post(){
                    //Create query
                    $query = 'SELECT * FROM '. $this->table.' WHERE pageID = :pageID';
                    //Preparing statement
                    $stmt = $this->conn->prepare($query);
                        //Clean data
                        $this->pageID =htmlspecialchars(strip_tags($this->pageID));
            
                        //Bind data
                        $stmt->bindParam(':pageID', $this->pageID);
                    //Executing query
                    $stmt->execute();
            
                    return $stmt;
    }

    
    //Create post
    public function create_post(){
        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            postTitle = :postTitle,
            pText = :pText,
            postDate = CURDATE(),
            username = :username,
            pageID = :pageID,
            imageURL = :imageURL';
            //Preparing statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->postTitle =htmlspecialchars(strip_tags($this->postTitle));
            $this->pText =htmlspecialchars(strip_tags($this->pText));
            $this->username =htmlspecialchars(strip_tags($this->username));
            $this->pageID =htmlspecialchars(strip_tags($this->pageID));
            $this->imageURL =htmlspecialchars(strip_tags($this->imageURL));

            //Bind data
            $stmt->bindParam(':postTitle', $this->postTitle);
            $stmt->bindParam(':pText', $this->pText);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':pageID', $this->pageID);
            $stmt->bindParam(':imageURL', $this->imageURL);

            //Executing query
            if($stmt->execute()){
                return true;
            }

            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
    }

        //Update post
        public function update_post(){
            //Update query
            $query = 'UPDATE ' . $this->table . '
            SET
                postTitle = :postTitle,
                pText = :pText,
                postDate = CURDATE(),
                username = :username
            WHERE
                postID = :postID';
    
                //Preparing statement
                $stmt = $this->conn->prepare($query);
    
                //Clean data
                $this->postTitle =htmlspecialchars(strip_tags($this->postTitle));
                $this->pText =htmlspecialchars(strip_tags($this->pText));
                $this->username =htmlspecialchars(strip_tags($this->username));
                $this->postID =htmlspecialchars(strip_tags($this->postID));
    
                //Bind data
                $stmt->bindParam(':postTitle', $this->postTitle);
                $stmt->bindParam(':pText', $this->pText);
                $stmt->bindParam(':username', $this->username);
                $stmt->bindParam(':postID', $this->postID);
    
                //Executing query
                if($stmt->execute()){
                    return true;
                }
    
                //Print error
                printf("Error: %s.\n", $stmt->error);
                return false;
        }

        //Delete post
        public function delete_post_page(){
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

	public function delete_post(){
            //Creating query
            $query = 'DELETE FROM '. $this->table .'
            WHERE postID = :postID';

            //Preparing statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->postID =htmlspecialchars(strip_tags($this->postID));

            //Bind data
            $stmt->bindParam(':postID', $this->postID);

            //Executing query
            if($stmt->execute()){
                return true;
            }
            
            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

}
Class Post_activate{
    //DB Stuff
    private $conn;
    private $table = 'post';

    //Post Properties
    public $postID;
    public $pText;
    public $postDate;
    public $imageURL;
    public $postTitle;
    public $pageID;
    public $username;
    public $serviceTitle;
    public $serviceDate;
    public $serviceType;

    //Constructor with db
    public function __construct($db){
        $this->conn = $db;
    }

        //Update publish BOOL to TRUE
        public function activate_post(){
            if(isset($_POST['post_activate_btn'])){
            $query = 'UPDATE ' . $this->table . 'SET publish = ?';

                //Preparing statement
                $stmt = $this->conn->prepare($query);

                //Clean data
                $this->publish = htmlspecialchars(strip_tags($this->publish));

               //Bind data
               $stmt->bindParam(1, $this->publish);

               //Executing query
              if($stmt->execute()){
                return true;
              }

              //Print error
               printf("Error: %s.\n", $stmt->error);
               return false;
            }
        }
        
        //Update publish BOOL to FALSE
        public function deactivate_post(){
            if(isset($_POST['post_deactivate_btn'])){
            $query = 'UPDATE ' . $this->table . 'SET publish = ?';

                //Preparing statement
                $stmt = $this->conn->prepare($query);

                //Clean data
                $this->publish =htmlspecialchars(strip_tags($this->publish));

                //Bind data
                $stmt->bindParam(0, $this->publish);

                //Executing query
                if($stmt->execute()){
                    return true;
                }

            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

}
//Post history class
Class Post_history{
    //DB Stuff
    private $conn;
    private $table = 'post';

    //Post Properties
    public $postID;
    public $pText;
    public $lastUpdate;
    public $postDate;
    public $imageURL;
    public $postTitle;
    public $pageID;
    public $username;
    public $serviceType;

    //Constructor with db
    public function __construct($db){
        $this->conn = $db;
    }

    public function read_post_history(){
        //Create query
        $query = 'SELECT * FROM post, spage WHERE post.pageID = spage.pageID';
        //Preparing statement
        $stmt = $this->conn->prepare($query);
        //Executing query
        $stmt->execute();

        return $stmt;
    }

}

?>