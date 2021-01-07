<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Comment.php';
//include_once gives a warning only if not found
//require_once throws an error if not found
//
require_once '../authentication/auth2.php'; 

//before everything check if API is set like this 
$API = "";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
// This way it could be either GET or POST.. ( Or SESSSION )


//You missed a paranthesis at the end of the function call
//Original: if(verify($API){
if(verify($API)){

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate comment object
$comment = new Comment($db);
$result = $comment->read_comment();

//Get row count
$num = $result->rowCount();

//Check if any comment
if($num > 0){
    //Comment array
    $comments_arr = array();
    $comments_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $comment_item = array(
            'commentID' => $commentID,
            'cText' => $cText,
            'cDate' => $cDate,
            'pageID' => $pageID,
            'cPublish' => $cPublish
        );

        //Push to "data"
        array_push($comments_arr['data'], $comment_item);
    }
    //Turn to JSON and output
    echo json_encode($comments_arr);

}else{
//No comments
echo json_encode(
    array('message' => 'No Comments Found')
);
}
}else{
     echo "false";
}

?>