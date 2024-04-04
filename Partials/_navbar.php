<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-white bg-white">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="font-family:Pristina; font-size:30px;color: black; ">JustAsk</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" style="color:black" href="Index.php">Home</a>
          </li>
          <?php
          if(isset ($_SESSION['username'])){
          echo '<li class="nav-item">
            <a class="nav-link" style="color:black" href="logout.php">Logout</a>
          </li>';} 
          if(!isset ($_SESSION['username'])){
          echo  '<li class="nav-item">
            <a class="nav-link" style="color:black" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black" href="signup.php">Signup</a>
          </li>';} ?>
          <li>
            
          <form style="margin-left:5px" class="d-flex"  action="search.php" method="GET">
        <input class="form-control me-2" name="search" type="search" style="border:1px solid black; border-radius:10px;" placeholder="Search Quries" aria-label="Search">
        <button class="btn btn-outline-danger" style="border-radius:10px" type="submit">Search</button>
      </form></li>
          <li class="nav-item" style="margin-left:3px">
          <a  type="submit" class="btn btn-danger" href="Partials/_threadform.php" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
Ask Query
</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
