<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    // Skicka dig till error.php
    header('location:/gitten/Wikiwider/html/');
    exit;
}

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];

    $data = array(
        'user' =>''.$user,
        'pass' =>''.$pass,
        'firstName' =>''.$firstName,
        'middleName' =>''.$middleName,
        'lastName' =>''.$lastName
    );

    $payload = json_encode($data);      //konverterar in till Json
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/create_user.php?");  //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
/*
    if($result == 'nono'){
        header('location: index.html');
    }
    else{
        //skicka till loggedin.php
    }
    */
    ?>
