<?php 
    class Search{
        private $conn;
        private $table = 'spage';
    
        public $pageTitle;
        public $search;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read_Title(){
            $sql = 'SELECT pageTitle
            FROM '.$this->table. '
            WHERE pageTitle LIKE "%"?"%"';
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->search);
        $stmt->execute();
        
        return $stmt;
        }
    }
?>