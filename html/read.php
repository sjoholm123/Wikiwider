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
    
  // payloaden behövs när du ska posta data, $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/read_post_page.php?API=$API&pageID=$pageID");    //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);  // echo $result för att kolla om executen funka

    $decoded = json_decode($result, true);

    print_r($decoded);

    echo $decoded['posts']['0']['postTitle'];
    echo $decoded['posts']['0']['pText'];
?>