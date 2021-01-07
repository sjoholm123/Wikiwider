<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../authentication/auth2.php';
include_once '../../config/Database.php';
include_once '../../models/History.php';

//before everything check if API is set like this 
$API = "";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
// This way it could be either GET or POST.. ( Or SESSSION )

if(verify($API)) {
        
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate history object
$history = new History_history($db);
$result = $history->read_history();

//Get row count
$num = $result->rowCount();

//Check if any History
if($num > 0){
	//History array
        $history_arr = array();
        $history_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $history_item = array(
                'postTitle' => $postTitle,
                'pText' => $pText,
                'pageID' => $pageID
            );

            //Push to "data"
            array_push($history_arr['data'], $history_item);
        }
        //Turn to JSON and output
        echo json_encode($history_arr);

        } else{
        //No History
        echo json_encode(
            array('message' => 'No History Found')
        );
        }

} else {
    echo "false";
}

?>