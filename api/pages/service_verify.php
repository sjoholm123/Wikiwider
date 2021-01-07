<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

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

//Instantiate service object
$service = new Service($db);

//Get userID from URL
$service->userID = isset($_GET['userID']) ? $_GET['userID'] : die();

//Get service
$service->service_verify();

//Create array
$service_arr = array(
    'userID' => $service->userID,
    'serviceType' => $service->serviceType
);

//Make JSON
print_r(json_encode($service_arr));
}else{
    echo FALSE;
}
?>