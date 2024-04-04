

<!doctype html>
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
            min-height: 100vh;
            
            justify-content: center;
            align-items: center;
        }

        .container {
          margin-top:3em;
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
  <body >
    <?php 
    include 'db.php';
    include 'Partials/_navbar.php';


if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Check if the username exists in the database
    $sql = "SELECT * FROM `users_data` WHERE `username`='$username'";
    $result = mysqli_query($conn, $sql);
    
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        // Fetch the associated password from the database
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['user_pass'];
        $user_id= $row['user_id'];

        // Verify the entered password against the hashed password from the database
        if (password_verify($password, $hashed_password)) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            header("Location: Index.php");
            exit;
        } 
        else {
          echo '<div class="alert alert-danger" role="alert">
   invalid password
</div>';
        }
    } else {
      echo '<div class="alert alert-danger" role="alert">
  Username doesnt exists
</div>';
    }
}

?>
   
    <div class="container" >
      <h1 style="text-align: center;">Login</h1>
      
   <form method="POST" action="login.php">
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" name="user" class="form-control" id="exampleInputEmail1" >
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
  </div>
 
 
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
  
  </body>
</html>





