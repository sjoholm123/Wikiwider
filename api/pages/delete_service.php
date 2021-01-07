<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Service.php';
include_once '../authentication/auth2.php';
$API="";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
if(verify($API)){

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate post object
$service = new Service($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set pageID to DELETE
$service->serviceID = $data->serviceID;

//Delete post
if($service->delete_service()){
    echo json_encode(
        array('message' => 'Service Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Service Not Deleted')
    );
}
}else{
    echo FALSE;
}