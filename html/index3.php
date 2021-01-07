<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLoggedin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
       $_SESSION['API'];
       $_SESSION['password'];
    } else {
        header('Location: index.html');
    }
    ?>
        <img class="marvel" src="bilder/marvelwiki.png">
        <form action="search.php" method="get">
        <div class="search"><input type="text" placeholder="Search for.." name="pageTitle"></div>
     <button type="submit" class="far fa-search blackhover">
</button>
    </form>
        <div class="backgroundicon">
        <i class="far fa-sign-out blackhover" id="sign-out" onclick="location.href='index.html';"></i>
        <i class="fas fa-user blackhover" id="register"></i>
        </div>  
</body>
<script src="popUpLocal.js"></script>
<script type="text/javascript" src="marvel.js"></script>
</html>