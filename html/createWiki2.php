<?php
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
       $_SESSION['password'];

    $API = $_SESSION['API'];
} else {
    header('Location: index.html');
}
    // POST med genom form


    $postTitle = $_POST['postTitle'];
    $pText = $_POST['pText'];
    $username = $_POST['username'];
    $pageID = $_POST['pageID'];

    var_dump($_POST['pText']);
    var_dump(count($_POST['postTitle']));
    for($i=0;$i<count($_POST['postTitle']); $i++) {
        echo ($_POST['postTitle'][$i]);
        echo ($_POST['pText'][$i]);


    $data = array(
        'postTitle' => ''.$_POST['postTitle'][$i],
        'pText' => ''.$_POST['pText'][$i],
        'username' => ''.$username,
        'pageID' => ''.$pageID
    );


    $payload = json_encode($data);      //konverterar in till Json

    $ch = curl_init("https://wider.ntigskovde.se/api/pages/create_post.php?API=$API");  //kolla så att filsökvägen är rätt /api/*/*.php?API=$API
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    
    curl_close($ch);

    }
    
    if($result == 'nono'){
        header('location: index.html');
    }
    else{
        //skicka till loggedin.php
        header('location: loggedin.php');
    }

    print_r($imageURL);
    echo $result;
    echo $result2;   // echo $result för att kolla om executen funka
?>