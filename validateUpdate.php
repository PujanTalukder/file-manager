<?php

session_start();


// database config info
$host = "localhost";
$user = "root";
$pass = "";
$DBname = "fms_db";


// connect to database
$conn = mysqli_connect($host, $user, $pass, $DBname);

// check connection error
if (mysqli_connect_errno()) {
    // if error occurs connecting to the db script stops and displays the error
    
    exit("Failed to connect : " . mysqli_connect_error());
}


// handling post request
if(isset($_POST["submit"])){
    $new_name = $_POST["update"];
    $file_name = $_SESSION["file_name"];
    $file_path = $_SESSION["file_path"];
    $new_file_path = "uploads/" . $new_name;
    $id = $_SESSION["file_id"];



    $sql = "UPDATE file_upload SET name='$new_name' WHERE id=$id";

    if(mysqli_query($conn, $sql)){
        if(file_exists($file_path)){
            if(rename($file_path, $new_file_path)){
                header("Location: home.php");
            }
        }else{
            echo "can't update";
        }
    }else{
        echo "error <br/>";
    }
}


?>