<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Partials/css/deco.css">

    <title>Hello, world!</title>
    <style>
        body {
            background-color: lightgrey;
            min-height: 110vh;
            
            justify-content: center;
            align-items: center;
        }

        .container {
          margin-top:2em;
            width: 500px;
            padding: 2em;
            position: relative; /* Set position to relative */
        }

        .alert {
            position: relative; /* Set position to absolute */
            top: 0; /* Position alert at the top of the container */
            left: 0; /* Position alert at the left of the container */
            width: 100%; /* Make alert full width of the container */
        }
    </style>
</head>
<body>
<?php
include 'db.php';
include 'Partials/_navbar.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['user'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass1'];
    $passc = $_POST['pass2'];
    $exist = false;

    $sql = "SELECT * FROM `users_data` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 0) {
        if ($pass == $passc) {
            $hashed= password_hash($pass, PASSWORD_DEFAULT) ;

            // Insert user into the database
            $query = "INSERT INTO `users_data`(`username`, `user_mail`, `user_pass`) VALUES ('$username', '$mail', '$hashed')";
            $resultt = mysqli_query($conn, $query);
            header( "Location: login.php" );
            exit;
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Passwords do not match
                  </div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Username already exists
              </div>';
    }
}
?>

<div class="container">
    <h1 style="text-align: center;">SignUp</h1>
    <form method="POST" action="signup.php">
        <div class="mb-3">
            <label for="exampleusername" class="form-label">Username</label>
            <input type="text" name="user" class="form-control" id="exampleusername">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="pass1" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="pass2" class="form-control" id="exampleInputPassword1">
            <div id="emailHelp" class="form-text">Make sure that the password is the same!</div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
