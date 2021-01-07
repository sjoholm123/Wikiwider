<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    // Skicka dig till error.php
    header('location:/gitten/Wikiwider/html/');
    exit;
}

    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] .  "</p>");
       $_SESSION['password'];

    $API = $_SESSION['API'];
} else {
    header('Location: index.html');
}

    $pageTitle = $_POST['pageTitle'];   // POST med genom form
    $serviceID = '7';

    $data = array(                      //datan du skickar med i formen
        'pageTitle' => ''.$pageTitle,
        'serviceID' => ''.$serviceID
    );

    
    $payload = json_encode($data);      //konverterar in till Json
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/create_page.php?API=$API");  //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);


    if($result == 'nono'){
        header('location: index.html');
    }
    else{
        //skicka till loggedin.php
        header("'Location: createPost.php?");
        echo $result;
    }
       
    // echo $result för att kolla om executen funka
?>