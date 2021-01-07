<?php
    session_start();

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $data = array(
        'username' => ''.$username,
        'password' => ''.$password
    );

    
    $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/user/authenticate_user.php");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    if($result == 'nono'){
        header('location: index.html');
    }
    else{
        $_SESSION['API'] = trim($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        //skicka till loggedin.php
        header('location: loggedinLocal.php');
    }
    echo $result;
?>