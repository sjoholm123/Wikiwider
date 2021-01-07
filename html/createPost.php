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
 
<?php
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
        echo "<p class='pageID'>ooga". strtoupper($_SESSION['pageID'] . "</p>");
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/highlight.js"></script>
<script src="js/popUpLocal.js"></script>
<script src="js/alert.js"></script>
<script type="text/javascript" src="js/marvel.js"></script>
<script src="js/menu.js"></script>
</html>