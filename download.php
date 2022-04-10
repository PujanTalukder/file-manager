<?php

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

if (isset($_GET["file_id"])) {
    $id = $_GET["file_id"];

    $sql = "SELECT * FROM file_upload WHERE id=$id";

    $data = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($data);

    $file_path = "uploads/" . $file["name"];

    // check if file exists or not
    if (file_exists($file_path)) {
        header("Content-Type: application/octet-stream");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=" . basename($file_path));
        header("Expires: 0");
        header("Cache-Control: must-revalidate");
        header("Pragma:public");
        header("Content-Length:" . filesize("uploads/" . $file["name"]));

        readfile("uploads/" . $file["name"]);

        header("Location: home.php");
    }
}
