<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylingSearch.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="header">
            <img class="marvel" src="bilder/marvelwiki.png">
    </div>
    <div class="menu-btn" id="one">
        <i class="fas fa-user"></i>
        </div>
        <div class="menu-btn" id="two">
            <i class="fas fa-plus"></i>
        </div>  
        <div class="menu-btn signOut" id="three" onclick="location.href='logout.php'">
            <i class="fas fa-sign-out-alt"></i>
        </div>  
    <div class="containS">
    <img onmouseover="mouseoverBox1()" onmouseout="onmouseoutBox1()" class="image" id="spider" src="bilder/spiderman.png">
    <div class="redBG" id="edit" onmouseover="mouseoverBox1()" onmouseout="onmouseoutBox1()">SPIDER-MAN</div>
</div>
<div class="containC">
    <img onmouseover="mouseoverBox2()" onmouseout="onmouseoutBox2()" class="image" id="captain" src="bilder/captain.png">
    <div class="redBG" id="create" onmouseover="mouseoverBox2()" onmouseout="onmouseoutBox2()">CAPTAIN AMERICA</div>
</div>
<div class="containH">
    <img onmouseover="mouseoverBox3()" onmouseout="onmouseoutBox3()" class="image" id="hulk" src="bilder/hulk.png">
    <div class="redBG" id="delete" onmouseover="mouseoverBox3()" onmouseout="onmouseoutBox3()">THE HULK</div>
</div>
<div class="containT">
    <img onmouseover="mouseoverBox4()" onmouseout="onmouseoutBox4()" class="image" id="thor" src="bilder/thor.png">
    <div class="redBG" id="logout" onmouseover="mouseoverBox4()" onmouseout="onmouseoutBox4()" onclick="location.href='index.html';">THOR</div>
</div>
<form class="form" action="search.php" method="get">
<input class="search" id="holder" type="text" placeholder="Search for.." name="pageTitle">
 <button type="submit"><i id="submit" class="far fa-search blackhover"></i>
     </button>
    </form>
    <form class="new-article" action="newPage.php" method="POST">
        <h1 class="h1">New Article</h1>
        <input class="Title" type="text" placeholder="Article Title" name="pageTitle">
        <input class="article-submit" value="Create" type="submit">
        <button type="button" class="cancel">Cancel</button>
    </form>
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
    echo "<div class='table' id='table'>";

   
    foreach ($bos as $row){
               echo nl2br ("<a href='delete.php?pageID=$row->pageID' class='far fa-times'></a><a href='read.php?pageID=$row->pageID' class='aText' id='$row->pageID' name='pageID'>$row->pageTitle</a>");   
               echo "<br>";
    }
    echo '</div>';
} else {
    header('Location: index.html');
}
    ?>

</body>
<script src="js/menu.js"></script>
<script src="js/highlight.js"></script>
<script src="js/alert.js"></script>
</html>