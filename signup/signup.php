<?php

    // start the session
    session_start();

    // database config info
    $host = "localhost";
    $user = "root";
    $pass = "";
    $DBname = "fms_db";

    // connect to database
    $conn = mysqli_connect($host, $user, $pass, $DBname);

    // check connection error
    if(mysqli_connect_errno()){
        // if error occurs connecting to the db script stops and displays the error
        exit("Failed to connect : " . mysqli_connect_error());
    }

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];


        $sql = $conn->prepare("INSERT INTO users(username,password,email) VALUES(?,?,?)");

        if($sql->execute([$username, $password, $email])){
            header("Location: successful.php");
            $_SESSION["user"] = $_POST["username"];
        }

    }




?>