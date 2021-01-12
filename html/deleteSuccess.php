<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/deleteSuccessLocal.css">
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

    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
       $_SESSION['password'];

    $API = $_SESSION['API'];
    $pageTitle = $_REQUEST['pageTitle'];

    $data = array(
        'pageTitle' =>''.$pageTitle,
    );

    $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/search_page.php?API=$API&search=$pageTitle&serviceID=7");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $bos = json_decode($result);
    echo "<table class='table' id='table' cellpadding='15' cellspacing='15'>";
    echo "<tr>";
    echo "<td>";

    foreach ($bos as $row){
               echo nl2br ("<a href='delete.php?pageID=$row->pageID' class='far fa-times'></a><a href='read.php?pageID=$row->pageID' class='aText' id='$row->pageID' name='pageID'>$row->pageTitle</a>");   
               echo "<br>";
    }
    echo '</tr>';
    echo '</td>';
    echo '</table>';
} else {
    header('Location: index.html');
}
    ?>
        <a class="deleteText">DIN ARTIKEL ÄR NU BORTTAGEN</a>
        <img class="marvel" src="bilder/marvelwiki.png">
        <form action="search.php" method="get">
        <div class="search"><input type="text" placeholder="Search for.." name="pageTitle"></div>
     <button type="submit" class="far fa-search blackhover">
</button>
    </form>
        <div class="backgroundicon">
        <i class="far fa-sign-out blackhover" id="sign-out" onclick="location.href='index.html';"></i>
        <i class="fas fa-user blackhover" id="register"></i>
        <i class="fas fa-file-plus blackhover" id="file" onclick="location.href='createWikiLocal.html';"></i>
        </div>  
</body>
<script src="js/popUpLocal.js"></script>
<script src="js/alert.js"></script>
<script type="text/javascript" src="js/marvel.js"></script>
</html>