<?php
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {  //global username och API, skicka med username till varje sida
        echo "<p class='user'>" . strtoupper($_SESSION['username'] . "</p>");
       $_SESSION['password'];

    $API = $_SESSION['API'];
} else {
    header('Location: index.html');
}

    /*if(isset($_FILES['imageURL'])) {
        $imageURL = $_FILES['imageURL'];
        print_r($imageURL);
    }
*/
    // POST med genom form


    $imageURL = $_FILES['imageURL'];
    $postTitle = $_POST['postTitle'];
    $pText = $_POST['pText'];
    $username = $_POST['username'];
    $pageID = $_POST['pageID'];


    $data2 = array(
        "name" => $_FILES['imageURL']['name'],
        "path" => $_FILES['imageURL']['tmp_name'],
        "type" => $_FILES['imageURL']['type'],
        "serviceID" => 7
    );

    for($i=0;$i<count($_POST['postTitle']); $i++) {
        echo ($_POST['postTitle'][$i]);
        echo ($_POST['pText'][$i]);


    $data = array(
        'postTitle' => ''.$_POST['postTitle'][$i],
        'pText' => ''.$_POST['pText'][$i],
        'username' => ''.$username,
        'pageID' => ''.$pageID
    );
    
    $payload = json_encode($data);
    $payload2 = json_encode($data2);

    $ch = curl_init();
    $ch2 = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://wider.ntigskovde.se/api/pages/create_post.php?API=$API");
    curl_setopt($ch2, CURLOPT_URL, "https://wider.ntigskovde.se/api/image/create_image.php?API=$API");

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $payload2);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $mh = curl_multi_init();

    curl_multi_add_handle($mh, $ch);
    curl_multi_add_handle($mh, $ch2);

    do {
        $status = curl_multi_exec($mh, $active);
        if ($active) {
            curl_multi_select($mh);
        }
    } while ($active && $status == CURLM_OK);

}

curl_multi_remove_handle($mh, $ch);
curl_multi_remove_handle($mh, $ch2);
curl_multi_close($mh);


    if($status != CURLM_OK){
        header('location: index.html');
    }
    else{
        //skicka till loggedin.php
        header('location: loggedin.php');
    }
    
    echo $status;        // echo $result för att kolla om executen funka
?>