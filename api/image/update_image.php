<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Image.php';
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

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$Image->serviceID = $data->serviceID;
$Image->name = $data->name;
$Image->path = $data->path;
$Image->type = $data->type;
//name	path	type	serviceID 
//Create post
if($Image->update_image()){
    echo json_encode(
        array('message' => 'Image Update')
    );
}else{
    echo json_encode(
        array('message' => 'Image Not Update')
    );
}}else{
    echo FALSE;
}
?>