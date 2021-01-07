<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';
include_once '../authentication/auth2.php';
$API = "";
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
/*commentobject Array
*/

//Set commentID to DELETE
$comment->commentID = $data->commentID; // Pillar på detta just nu 

print_r($comment->commentID);
//Delete comment
if($comment->delete_comment()){
    echo json_encode(
        array('message' => 'Comment Deleted')
    );
}else{
    echo json_encode(
        array('message' => 'Comment Not Deleted')
    );
}
}
else
echo FALSE;