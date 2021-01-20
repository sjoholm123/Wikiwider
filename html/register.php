<?php
    session_start();

    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];

    echo $user;
    echo $firstName;
    echo $middleName;
    echo $lastName;
    
    $data = array(
        'username' => ''.$user,
        'password' => ''.$pass,
        'firstName' => ''.$firstName,
        'middleName' => ''.$middleName,
        'lastName' => ''.$lastName
    );

    
    $payload = json_encode($data);
    $ch = curl_init("https://wider.ntigskovde.se/api/user/create_user.php");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
/*
    if($result == 'nono'){
        header('location: index.html');
    }
    else{
        $_SESSION['API'] = trim($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        //skicka till loggedin.php
        header('location: loggedin.php');
    }
    */
    echo $result;
?>