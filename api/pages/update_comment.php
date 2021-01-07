<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';
include_once '../authentication/auth2.php';
$API="";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
if(verify($API)){
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate comment object
$comment = new Comment($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set commentID to UPDATE
$comment->commentID = $data->commentID;

$comment->cText = $data->cText;
$comment->pageID = $data->pageID;
$comment->commentID = $data->commentID;

//Update comment
if($comment->update_comment()){
    echo json_encode(
        array('message' => 'Comment Updated')
    );
}else{
    echo json_encode(
        array('message' => 'Comment Not Updated')
    );
}
}else{
    echo FALSE;
}
?>