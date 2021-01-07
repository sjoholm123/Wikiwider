<?php
function verify($API = null){
    if ($API === null) {
        if (isset($_REQUEST['apikey'])) {
            $API = $_REQUEST['apikey'];
        }    
    };

    if ($API === null) {
        return;
    }
    
    include_once '../../config/Database.php';    
    $database = new Database();
    $db = $database->connect();

    $SQL = "SELECT TIMESTAMPDIFF(SECOND, expiration,CURRENT_TIME()) as time FROM user WHERE apiKey = :apikey";
    $stmt = $db->prepare($SQL);
    $stmt->bindParam(':apikey', $API);                  
    $stmt->execute(); 
    
    if ($stmt->rowcount() > 0) {
        while($row = $stmt->fetch( PDO::FETCH_ASSOC )) {
            if($row['time']>1800){
                // "Time out";
				echo "tiemaout";
                return false;
            } else {
                $SQL ="UPDATE user SET expiration=CURRENT_TIME() WHERE apiKey = :apikey";
                $stmt = $db->prepare($SQL);
                $stmt->bindParam(':apikey', $API,PDO::PARAM_STR);
                $stmt->execute();
                return true;
            }
        }
    } 

    //"Wrong API";
    return false;
}

?>