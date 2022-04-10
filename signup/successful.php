<?php

    session_start();

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
      margin: 0;
      padding: 0;
      box-sizing: border-box;
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
            padding: 2rem;
            margin: 50px auto;
            background: #fff;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1);
        }
        .container h2,
        .container h3{
            margin: 1.5rem 1rem;
        }
        a { 
            text-decoration: none;
            font-size: 1.1rem;
            margin-top: 1rem;
            padding: 8px 10px;
            border-radius: 5px;
            outline: none;
            border: none;
            width: 85%;
            background: rgb(8, 13, 164);
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="app">
        <div class="container">
        <h2><?php echo "Congratulation!! " . $_SESSION["user"]; ?></h2>
        <h3>your account is successfully created.</h3>
        
        <?php session_destroy()?>

        <a href="../login/login.html">go to login page</a>
        </div>
    </div>
    
</body>
</html>