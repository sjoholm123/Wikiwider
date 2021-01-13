<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/readStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
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

$pageID = $_GET['pageID'];   // GET genom form eller href 
    
  // payloaden behövs när du ska posta data, $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/read_post_page.php?API=$API&pageID=$pageID");    //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
   
    //$json = json_encode($result)
  $json = json_decode($result, true);
  print_r($json);
  echo '<div class="postTitle">';
  echo $json['posts']['0']['postTitle'];
  echo '</div>';
  echo $json['posts']['0']['pText'];

?>
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/highlight.js"></script>
<script src="js/popUpLocal.js"></script>
<script src="js/alert.js"></script>
<script type="text/javascript" src="js/marvel.js"></script>
<script src="js/menu.js"></script>
</html>