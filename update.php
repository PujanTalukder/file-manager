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



$file = [];

if(isset($_GET["file_id"])){
    $id = $_GET["file_id"];

    $sql = "SELECT * FROM file_upload WHERE id=$id";
    $data = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($data);
    $file_path = "uploads/" . $file["name"];

    $_SESSION["file_id"] = $id;
    $_SESSION["file_path"] = $file_path;
    $_SESSION["file_name"] = $file["name"];
}







?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File-Manager</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

        * {
          font-family: "Poppins", sans-serif;
        }

         body {
            background: #dfe9f5;
        }
        .app {
          width: 100%;
          height: 100vh;
          display: flex;
          justify-content: center;
          align-items: center;
        }

        .container{
            padding: 1.5rem;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
            width: 380px
        }
        .container h2,
        .container h3{
            margin: 1.5rem 1rem;
        }

        #button {
            font-size: 1.1rem;
            padding: 15px;
            border-radius: 5px;
            outline: none;
            border: none;
            width: auto;
            background: rgb(8, 13, 164);
            color: #fff;
            cursor: pointer;
            margin-left: 8px;
        }

        form {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            align-items: center;

        }

        #text {
            padding: 1rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            font-size: 1rem;
        }

        
    </style>
</head>
<body>
    <div class="app">
        <div class="container">
            <h2>Rename file</h2>
            <form action="validateUpdate.php" method="post">
                <input type="text" name="update" id="text" value="<?php echo $file["name"]?>">
                <input type="submit" name="submit" id="button" value="update">
            </form>
        </div>
    </div>
</body>
</html>