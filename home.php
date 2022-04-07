<?php

    // start session to use session variable
    session_start();

    // if user is not logged in redirect to login page
    if(!isset($_SESSION["loggedin"])){
        header("Location: login.html");
        exit;
    }




?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File-Manager</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body>
<nav class="navtop">
			<div>
				<h1>FMS</h1>
				<a  style="pointer-events: none;" href="#" id="profile"><i class="fas fa-user-circle"></i><?= $_SESSION["name"]?></a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>This is content</p>
		</div>
</body>
</html>