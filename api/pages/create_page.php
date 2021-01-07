<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/page.php';
include_once '../authentication/auth2.php';
$API="";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
if(verify($API)){
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate post object
$page = new page($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$page->serviceID = $data->serviceID;
$page->metaTag = $data->metaTag;
$page->pageTitle = $data->pageTitle;

//Create post
if($page->create_page()){
    echo json_encode(
        array('message' => 'Page Created')
    );
}else{
    echo json_encode(
        array('message' => 'Page Not Created')
    );
}
}else{
    echo FALSE;
}
?>

