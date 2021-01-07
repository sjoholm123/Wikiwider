<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    // Skicka dig till error.php
    header('location:/gitten/Wikiwider/html/');
    exit;
}

    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
       $_SESSION['password'];

    $API = $_SESSION['API'];
} else {
    header('Location: index.html');
}

$pageID = $_GET['pageID'];      // GET genom form eller href 

        $data = array(
        'pageID' => ''.$pageID          
    );

    
    $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/delete_page.php?API=$API&pageID=$pageID");    //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
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
        header('location: deleteSuccess.php');
    }

    echo $result;  // echo $result för att kolla om executen funka
?>