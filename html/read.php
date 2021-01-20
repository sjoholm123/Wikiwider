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
<div class="container"></div>
<div class="menu">
  <div class="header">
    <img class="image" src="bilder/marvelwiki.png">
  <i class="far fa-times" id="menuCross"></i>
  </div>
  
  <form class="form" action="search.php" method="get">
<input class="search" id="holder" type="text" placeholder="Search for.." name="pageTitle">
</form>
<div class="line"></div>
<button class="text logOut"  onclick="location.href='logout.php'">Logga Ut</button>
<button class="text skapa">Skapa Ny Artikel</button>
<button class="text home"  onclick="location.href='loggedin.php'">Hem</button>
</div>

<i class="far fa-bars" id="bars"></i>
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

   session_start();

   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
       echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
      $_SESSION['password'];

   $API = $_SESSION['API'];
   $username = $_SESSION['username'];
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

  $pageTitle = $json['posts']['0']['pageTitle'];
  
  echo '<div class="pageTitle">';
  echo $json['posts']['0']['pageTitle'];
  

  echo '<div class="cokeline">';

  for($i=0; $i < count($json['posts']); $i++) {
    $postID = $json['posts'][$i]['postID'];
    echo '<div class="postTitle">';
    echo $json['posts'][$i]['postTitle'];
    echo '<a href="deletePost.php?postID='.$postID.'" class="far fa-times delete"></a>';
    echo '<a href="edit_wiki1.php?postID='.$postID.'" class="fas fa-pen edit"></a>';
    echo '</div>';
    echo '<div class="pText">';
    echo $json['posts'][$i]['pText'];
    echo '</div>';
    echo '<div class="postDate">';
    echo $json['posts'][$i]['postDate'];
    echo '</div>';
  }

  echo '<div class="imageURL">';
  echo $json['posts']['0']['imageURL'];
  echo '</div>';

  echo '<form class="create" action="newPost.php?pageID='.$pageID.'pageTitle='.$pageTitle.'" method="POST">
  
  <div class="create"><button class="bababoi type="submit">Skapa Post</button></div>
</form>';

  echo '</div>';


  echo '<div class="imageURL">';
  echo $json['posts']['0']['imageURL'];
  echo '</div>';

 /* echo '<form class="create" action="edit_wiki.html?postID='.$postID.'pageTitle='.$pageTitle.'" method="POST">
  
  <div class="create"><button class="button type="submit">Edit Page</button></div>
</form>';
  */


?>
  
</body>
<script src="js/newArticle.js"></script>
<script src="js/hamburgerMenu.js"></script>
<script src="js/alertPost.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</html>