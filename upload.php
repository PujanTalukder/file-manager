<?php

    session_start();

    $userid = $_SESSION["name"];

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

    if(isset($_POST["upload"])){
        // get file info using $_FILE super globals
        $file_name = $_FILES["fileToUP"]["name"];
        $file_size = $_FILES["fileToUP"]["size"];

        $file = $_FILES["fileToUP"]["tmp_name"];

        // file extension
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

        // destination path
        $destination = "uploads/" . $file_name;

        // move actual file from the server to the destiantion directory
        if(move_uploaded_file($file, $destination)){
            $sql = "INSERT INTO file_upload (name,size,user) VALUES ('$file_name','$file_size','$userid')";

            if(mysqli_query($conn, $sql)){
                header("Location: home.php");
            }else{
                echo "error uploading file" . mysqli_error($conn);
            }
        }
    }


?>