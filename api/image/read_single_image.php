<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/image.php';
include_once '../authentication/auth2.php';
$API="";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
if(verify($API)){
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate post object
$Image = new Image_history($db);

//Get serviceID from URL
$Image->serviceID = isset($_GET['serviceID']) ? $_GET['serviceID'] : die();

//Get post
$Image->read_single_image();

//Create array
$Image_arr = array(
    'serviceID' => $Image->serviceID,
    'path' => $Image->path,
    'type' => $Image->type,
    'name' => $Image->name
);

//Make JSON
print_r(json_encode($Image_arr));
}else{
    echo FALSE;
}
?>