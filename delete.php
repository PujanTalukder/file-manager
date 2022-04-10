<?php

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

    if(isset($_GET["file_id"])){
        $id = $_GET["file_id"];

        $sql = "SELECT * FROM file_upload WHERE id=$id";

        $data = mysqli_query($conn, $sql);
    
        $file = mysqli_fetch_assoc($data);

        $file_path = "uploads/" . $file["name"];

        // query to delete file from db
        $sql_del = "DELETE FROM file_upload WHERE id=$id";

        if(mysqli_query($conn, $sql_del)){
            if(file_exists($file_path)){
                // delete file uploads directory
                unlink($file_path);
            }else{
                echo "can't remove file";
            }

            header("Location: home.php");
        }else{
            echo "cant delete file " . mysqli_error($conn);
        }
    }

    


?>