<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <title>Home</title>
    <style>
        a{
            text-decoration: none !important;
        }
    </style>
</head>
<body>
<?php
include 'Partials/_navbar.php';
include 'db.php';
include 'Partials/_threadform.php';

?>


<!-- Banner -->
<div style="margin-top:4em; ">

    <img width="400" height="400" src="pictures1/baner.png">
    <img width="700" height="400" src="pictures1/Query.png">
</div>

<div style="margin-top:4em; margin-left:5em; display: flex; flex-wrap:wrap ">
<img width="50" height="50" style="position:absolute; right:4em" src="pictures1/arrow.png">
    <div style="display: flex; ">
        <?php
        $sql = "SELECT * FROM `categories` WHERE `Cat_main`='Programming' LIMIT 4";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $cata = $row['Cat_main'];
            $id=$row['id'];
            if ($cata == 'Programming') {
                echo '<a href="threads.php?catid=' . $id . '"><div class="card text-white bg-secondary mb-3" style="max-width: 15rem; margin-right: 1em;">
              <div class="card-header">' . $row['Cat_main'] . '</div>
              <div class="card-body">
                <h5 class="card-title">' . $row['cat_name'] . '</h5>
                <p class="card-text">' . substr($row['cat_description'], 0, 60) . '...' . '</p>
              </div>
            </div></a>';
            }
            
            }
        
        ?>
    </div>
    <img width="50" height="50" style="position:relative; right4em; top:14em" src="pictures1/arrow.png">
    <div style="display: flex; margin-top:2em">
        <?php
        $sql_2 = "SELECT * FROM `categories` WHERE `Cat_main`='Fashion' LIMIT 4";
        $result_2 = mysqli_query($conn, $sql_2);

        while ($row = mysqli_fetch_assoc($result_2)) {
            $cata = $row['Cat_main'];
            if ($cata == 'Fashion') { // Use == for comparison
                echo '<a href="threads.php?catid=' . $id . '"><div class="card text-white bg-danger mb-3" style="max-width: 15rem; margin-right: 1em;">
<div class="card-header">' . $row['Cat_main'] . '</div>
<div class="card-body">
  <h5 class="card-title">' . $row['cat_name'] . '</h5>
  <p class="card-text">' . substr($row['cat_description'], 0, 60) . '...' . '</p>
</div>

</div></a>';
            }
        }
        ?>
    </div>
</div>
<?php
$year = date("Y");
echo 

'<footer style="text-align: center; padding: 3px; background-color: black; height:5em; margin-top:2em">
copyright &#169 gohar | '.$year.' 
      </footer>'
?>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
