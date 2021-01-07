<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/search.php';
include_once '../authentication/auth2.php';
$API="";
if(isset($_REQUEST['API']))
	$API = $_REQUEST['API'];
if(verify($API)){
$database = new Database();
$db = $database->connect();

$page = new Search($db);
$page->search = isset($_GET['search']) ? $_GET['search'] : die();

$result = $page->read_Title();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $page_arr = array();
    $page_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $page_item = array(
            'pageTitle' => $pageTitle
        );

        array_push($page_arr['data'], $page_item);
    }

    $page_arr['data']=array_map("unserialize", array_unique(array_map("serialize", $page_arr['data'])));
    echo json_encode($page_arr);

} else {
    echo json_encode(
        array('message' => 'No Pages Found')
    );
}}else{
    echo FALSE;
}

?>