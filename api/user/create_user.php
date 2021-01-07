<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/user.php';
include_once '../authentication/auth2.php';

$API = "";
if(isset($_REQUEST['API']))
    $API = $_REQUEST['API'];
    
if(verify($api)){


//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate user object
$user = new User($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set userID
$user->username = $data->username;
$user->password = $data->password;
$user->firstName = $data->firstName;
$user->middleName = $data->middleName;
$user->lastName = $data->lastName;
$user->admin = $data->admin;
if(verify($API)){

//Create user
	if($user->create_user()){
		echo json_encode(
			array('message' => 'User Created')
		);
	}else{
		echo json_encode(
			array('message' => 'User Not Created')
		);
	}
}
else{
    echo "False";
}