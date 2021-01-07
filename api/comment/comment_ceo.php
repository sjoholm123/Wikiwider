<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/comment.php';
include_once '../authenticate/auth2.php';
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];


if(verify($API)){
//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate comment object
$comment = new Comment($db);
$result = $comment->comment_ceo();

//Get row count
$num = $result->rowCount();

//Check if any comments
if($num > 0){
    //comment array
    $comments_arr = array();
    $comments_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $comment_item = array(
            'commentID' => $commentID,
            'cText' => $cText,
            'pageID' => $pageID,
            'cPublish' => $cPublish,
        );

        //Push to "data"
        array_push($comments_arr['data'], $comment_item);
    }
    //Turn to JSON and output
    echo json_encode($comments_arr);

}else{
//No comments
echo json_encode(
    array('message' => 'No comments Found')
);
}
else
echo FALSE;

?>