<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';
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

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->postTitle = $data->postTitle;
$post->pText = $data->pText;
$post->username = $data->username;
$post->pageID = $data->pageID;
$post->imageURL = $data->imageURL;

//Create post
if($post->create_post()){
    echo json_encode(
        array('message' => 'Post Created')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
}else{
    echo FALSE;
}
?>