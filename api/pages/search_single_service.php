,<?php
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

//Instantiate post object
$service = new Service($db);

//Get serviceID from URL
$service->serviceID = isset($_GET['serviceID']) ? $_GET['serviceID'] : die();

//Get post
$service->search_service();

//Create array
$service_arr = array(
    'serviceID' => $service->serviceID,
    'serviceTitle' => $service->serviceTitle,
    'pageID' => $service->pageID,
    'publish' => $service->publish,
    'serviceType' => $service->serviceType
);

//Make JSON
var_dump($service_arr);
//print_r(json_encode($service_arr));
}else{
    echo FALSE;
}
?>