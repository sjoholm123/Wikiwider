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

$result = $page->search_service_Title();
$rowCount = $result->rowCount();

if($rowCount > 0){
    $page_arr = array();
    $page_arr['service'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $page_item = array(
            'serviceTitle' => $serviceTitle,
            'serviceDate' => $serviceDate,
            'serviceType' => $serviceType,
            'publish' => $publish,
            'userID' => $userID
        );

        array_push($page_arr['service'], $page_item);
    }

    $page_arr['service']=array_map("unserialize", array_unique(array_map("serialize", $page_arr['service'])));
    echo json_encode($page_arr);

} else {
    echo json_encode(
        array('message' => 'No Pages Found')
    );
}}else{
    echo FALSE;
}


?>