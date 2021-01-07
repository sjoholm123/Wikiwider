<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/user.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$username = $_REQUEST['user'];
$password = $_REQUEST['pass'];

$user = new User($db);
$user->username = $username;
$user->password = $password;
$result = $user->authenticateUser();

if ($result['user'] || $result['admin']) {
    $SQL ="UPDATE user SET date=CURRENT_TIME(), apiKey='" . $result['API'] . "' WHERE username = '$username'";
    $stmt = $this->conn->prepare($SQL);
    $stmt->execute();
    echo $result['API'];
}
?>