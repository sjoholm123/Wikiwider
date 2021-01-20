<?php
   session_start();

   if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
       echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
      $_SESSION['password'];

   $API = $_SESSION['API'];
} else {
   header('Location: index.html');
}

$postID = $_POST['postID'];      // GET genom form eller href 
$pageTitle = $_POST['pageTitle'];
$postTitle = $_POST['postTitle'];
$pText = $_POST['pText'];

        $data = array(
        'postID' => ''.$postID,  
        'pageTitle' => ''.$pageTitle,
        'postTitle' => ''.$postTitle,
        'pText' => ''.$pText        
    );
     //datan som ska postas med i arrayen

    
  // payloaden behövs när du ska posta data,
    $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/pages/update_post.php?API=$API");    //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    /*if($result == 'nono'){
        header('location: index.html');
    }
    else{
        //skicka till loggedin.php
        header('location: loggedin.php');
    }
    */
    echo $result;  // echo $result för att kolla om executen funka

?>