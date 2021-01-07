<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../authentication/auth2.php';

if(verify($API)){
include_once '../../models/event.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate event object
$event = new Event($db);

//Get eventID from URL
$event->eventID = isset($_GET['eventID']) ? $_GET['eventID'] : die();

//Get event
$event->read_single_event();

//Create array
$event_arr = array(
    'eventID' => $event->eventID,
    'startDate' => $event->startDate,
    'eventTitle' => $event->eventTitle,
    'description' => $event->description,
    'endDate' => $event->endDate,
    'userID' => $event->userID,
    'inviteID' => $event->inviteID
);

//Make JSON 
print_r(json_encode($event_arr));
}else{
    header('../../login/login.php')
}
?>