<?php

Class User{
    //DB Stuff
    private $conn;
    private $table = 'user';

    //User Properties
    public $username;
    public $password;
    public $firstName;
    public $middleName;
    public $lastName;
    public $userID;
    public $admin;
	public $API;

    //Constructor with db
    public function __construct($db){
        $this->conn = $db;
    }

    public function read_user(){
        //Create query
        $query = 'SELECT * FROM user';
        //Preparing statement
        $stmt = $this->conn->prepare($query);
        //Executing query
        $stmt->execute();

        return $stmt;
    }
    
    //Get Single User
    public function read_single_user(){
        $query = 'SELECT * FROM user WHERE userID = ?';
        //Preparing statement
        $stmt = $this->conn->prepare($query);

        //Binding pageID
        $stmt->bindParam(1, $this->userID);

        //Executing query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Setting properties
        $this->userID = $row['userID'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->firstName = $row['firstName'];
        $this->middleName = $row['middleName'];
        $this->lastName = $row['lastName'];
        if($row['admin']==0)
        {
            $this->admin = "Nej";  
        }else
        {
            $this->admin = "Ja";
        }
        //$this->admin = $row['admin'];
    }

    //Create user
    public function create_user(){
		            function RandomString()
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randstring = '';
                for ($i = 0; $i < 20; $i++) {
                    $randstring = $randstring.$characters[rand(0, strlen($characters)-1)];
                }
                return $randstring;
            }

        //Create query
        $query = 'INSERT INTO ' . $this->table . '
        SET
            username = :username,
            password = :password,
            firstName = :firstName,
            middleName = :middleName,
            lastName = :lastName,
            admin = :admin,
			apiKey = :API,
			expiration = CURRENT_TIME()'
			;

            //Preparing statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->username =htmlspecialchars(strip_tags($this->username));
            $this->password =htmlspecialchars(strip_tags($this->password));
            $this->firstName =htmlspecialchars(strip_tags($this->firstName));
            $this->middleName =htmlspecialchars(strip_tags($this->middleName));
            $this->lastName =htmlspecialchars(strip_tags($this->lastName));
            $this->admin =htmlspecialchars(strip_tags($this->admin));

            $this->password=password_hash($this->password, PASSWORD_DEFAULT);

            //Bind data
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':middleName', $this->middleName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':admin', $this->admin);
            $stmt->bindParam(':API', RandomString());

            //Executing query
            if($stmt->execute()){
                return true;
            }

            //Print error
            printf("Error: %s.\n", $stmt->error);
            return false;
    }

        //Update user
        public function update_user(){
            //Update query
            $query = 'UPDATE ' . $this->table . '
            SET
                username = :username,
                password = :password,
                firstName = :firstName,
                middleName = :middleName,
                lastName = :lastName,
                admin = :admin
            WHERE
                userID = :userID';
    
                //Preparing statement
                $stmt = $this->conn->prepare($query);
    
                //Clean data
                $this->username =htmlspecialchars(strip_tags($this->username));
                $this->password =htmlspecialchars(strip_tags($this->password));
                $this->firstName =htmlspecialchars(strip_tags($this->firstName));
                $this->middleName =htmlspecialchars(strip_tags($this->middleName));
                $this->lastName =htmlspecialchars(strip_tags($this->lastName));
                $this->userID =htmlspecialchars(strip_tags($this->userID));
                $this->admin =htmlspecialchars(strip_tags($this->admin));

                //Bind data
                $stmt->bindParam(':username', $this->username);
                $stmt->bindParam(':password', $this->password);
                $stmt->bindParam(':firstName', $this->firstName);
                $stmt->bindParam(':middleName', $this->middleName);
                $stmt->bindParam(':lastName', $this->lastName);
                $stmt->bindParam(':userID', $this->userID);
                $stmt->bindParam(':admin', $this->admin);
                //Executing query
                if($stmt->execute()){
                    return true;
                }
    
                //Print error
                printf("Error: %s.\n", $stmt->error);
                return false;
        }
public function authenticateUser()
        {
            function RandomString()
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randstring = '';
                for ($i = 0; $i < 20; $i++) {
                    $randstring = $randstring.$characters[rand(0, strlen($characters)-1)];
                }
                return $randstring;
            }


            $array=["admin"=>FALSE, "user"=>FALSE, "notFound"=>FALSE, "API"=>""];
            $query=$this->conn->prepare("select username, password, admin,apiKey from user where username=?");
			$query->execute([$this->username]);
			if($query->rowCount()>0)
			{
				$row=$query->fetch();
				if(password_verify($this->password, $row[1]))
				{
					if($row[2]==1)
					{
						$SQL ="UPDATE user SET expiration=CURRENT_TIME() WHERE apiKey =:api";
						$query = $this->conn->prepare($SQL);
						$query->bindParam(':api',$row[3],PDO::PARAM_STR);
						$query->execute();
						$array['admin']=TRUE;
						$array['API']=$row[3];
						return $array;
					}
					else
					{
						$SQL ="UPDATE user SET expiration=CURRENT_TIME() WHERE apiKey =:api";
						$query = $this->conn->prepare($SQL);
						$query->bindParam(':api',$row[3],PDO::PARAM_STR);
						$query->execute();
						$array["user"]=TRUE;
						$array['API']=$row[3];
						return $array;
					}
				}
				else 
				{
					$array['notFound']=TRUE;
					return $array;
				}
			}
			else
			{
				$array["notFound"]=TRUE;
				return $array;
			}
        }
}

    //User history
    Class User_history{
        //DB Stuff
        private $conn;
        private $table = 'user';
    
        //User Properties
        public $username;
        public $password;
        public $firstName;
        public $middleName;
        public $lastName;
        public $moderator;
        public $admin;
        public $userID;
    
        //Constructor with db
        public function __construct($db){
            $this->conn = $db;
        }
    
        public function read_user_history(){
            //Create query
            $query = 'SELECT * FROM user, privilege WHERE user.userID = privilege.userID';
            //Preparing statement
            $stmt = $this->conn->prepare($query);
            //Executing query
            $stmt->execute();
    
            return $stmt;
        }
    
    }

    class Auth{
    //DB Stuff
    private $conn;
    private $table = 'user';

    public $username;
    public $password;
    public $firstName;
    public $middleName;
    public $lastName;
    public $userID;
    
        public function __construct($db) {
            $this->conn = $db;
        }
    
        public function auth($user){

            $sql = 'SELECT * FROM user';

            $stmt = $this->conn->prepare($sql);
            
            $stmt->execute();
    
            $rowCount = $stmt->rowCount();
    
            if($rowCount > 0){
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if($user == $row){
                        return "true";
                    }
                }
                return "false";
            }
        }
    }    

?>