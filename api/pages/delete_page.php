<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
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
$post = new Post($db);
$page = new Page($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set pageID to DELETE
$post->pageID = $data->pageID;
$page->pageID = $data->pageID;

$post->delete_post_page();

//Delete post
if($page->delete_page()){
    echo json_encode(
        array('message' => 'Page Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Page Not Deleted')
    );
}}else{
    echo FALSE;
}?>