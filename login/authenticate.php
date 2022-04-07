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

    // check login form data
    if(isset($_POST["submit"])){
        // prepare sql statement
        $sql = $conn->prepare('SELECT id, password FROM users WHERE username = ?');

        // bind parameters
        $sql->bind_param('s', $_POST["username"]);
        $sql->execute();

        // store result
        $sql->store_result();

        // validate user
        if($sql->num_rows > 0){
            // if user exists bind results
            $sql->bind_result($id, $password);
            $sql->fetch();

            // verify password
            if($_POST["password"] === $password){
                // successful verification
                // regenerate session 
                session_regenerate_id();
                $_SESSION["loggedin"] = TRUE;
                $_SESSION["name"] = $_POST["username"];

                // redirect to home page
                header("Location: ../home.php");
            }else{
                // incorrect password
                echo "incorrect password";
            }
        
        }else{
            echo "incorrect username";
        }

    }else{
        echo "data not available";
    }




?>