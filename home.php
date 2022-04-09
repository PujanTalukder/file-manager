<?php

// start session to use session variable
session_start();

$userid = $_SESSION["name"];

// if user is not logged in redirect to login page
if (!isset($_SESSION["loggedin"])) {
    header("Location: login.html");
    exit;
}

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

// fetch data from file_upload table
$sql = "SELECT * FROM file_upload WHERE user='$userid'";

$data = mysqli_query($conn, $sql);

// convert fetched object into associative array
$files = mysqli_fetch_all($data, MYSQLI_ASSOC);


?>




<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File-Manager</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .content {
            display: flex;
            width: 100%;
            padding: 20px;
            flex-direction: column;
        }

        .input_form {
            padding: 2rem;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            background: rgb(234, 230, 230);
            margin: 0 3.5rem;
        }
        .data {
            margin: 2rem 3.5rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
            padding: 1rem 1rem;
            
        }

        #button {
            background-color: white;
            color: black;
            border: 2px solid #555555;
            padding: 6px 23px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            margin: 6px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        #button:hover {
          background-color: #555555;
          color: white;
        }

        #button-file{
            background-color: #555555;
            color: white;
            border: 2px solid #555555;
            padding: 6px 23px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            margin: 6px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        input[type=text] {
          padding: 6px 16px;
          margin: 8px 0;
          box-sizing: border-box;
        }
    </style>
</head>

<body>
    <nav class="navtop">
        <div>
            <h1>FMS</h1>
            <a style="pointer-events: none;" href="#" id="profile"><i class="fas fa-user-circle"></i><?= $_SESSION["name"] ?></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <div class="input_form">
            <div class="new_folder">
                <h4>Create New Folder</h4>
                <form action="" method="post">
                    <input type="text" name="new-folder">
                    <input type="submit" value="create" id="button" name="create">
                </form>
            </div>
            <div class="upload_data">
                <h4>Upload New File</h4>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <input type="file" id="button-file" name="fileToUP">
                    <br>
                    <input type="submit" id="button" value="upload" name="upload">
                </form>
            </div>
        </div>
        <div class="data">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">File Name</th>
                        <th scope="col">File Size</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($files as $file) : ?>
                        <tr>
                            <td><?php echo $file["name"]; ?></td>
                            <td><?php echo $file["size"]; ?></td>
                            <td>
                                <a href="download.php?file_id=<?php echo $file["id"];?>" style="text-decoration: none;"><i style="margin-right: 0.8rem;" class="fa fa-download" aria-hidden="true"></i>download</a>
                            </td>
                            <td>
                                <a href="#" style="text-decoration: none;"><i style="margin-right: 0.8rem; color: red" class="fa fa-trash" aria-hidden="true"></i>delete</a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>