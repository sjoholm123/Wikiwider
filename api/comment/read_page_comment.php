<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';
include_once '../authenticateion/auth2.php';

//before everything check if API is set like this 
$API = "";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
// This way it could be either GET or POST.. ( Or SESSSION )

if(verify($API)) {

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate comment object
$comment = new Comment($db);
$comment->pageID = isset($_GET['pageID']) ? $_GET['pageID'] : die();
$result = $comment->read_page_comment();

if(!empty($result)){
    echo json_encode($result);
}else{
    echo json_encode(
        array('message' => 'No Comments Found')
    );
}
}else{
   echo "false";
}



?>