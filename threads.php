<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <?php 
include 'Partials/_navbar.php';
$newid=$_GET['catid'];
include 'db.php';
include 'Partials/_threadform.php';

$sql = "SELECT * FROM `categories` WHERE `id`= $newid";
$query= mysqli_query($conn,$sql);
$rows= mysqli_fetch_assoc($query);

echo ' <div style="height:300px; width:1000px; background-color:#DC3545; color:white;margin:0em 7em; text-align:center; padding:2em">
<h1>
  '. $rows['cat_name'] .'
</h1>
<p>'. $rows['cat_description'] .'
</p>
</div>';

$sql_sec = "SELECT * FROM `threads` WHERE `thread_cat_id`= $newid";
$query_sec= mysqli_query($conn,$sql_sec);

$num= mysqli_num_rows($query_sec);

echo '<div style=" margin-left:3em; margin-top: 1em"; margin-bottom:2em> 
<button type="button" class="btn btn-dark position-relative">
  Questions
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    '.$num.'
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
</div>';

if($num > 0) {
    while($rows_sec= mysqli_fetch_assoc($query_sec)){
        $thread_id= $rows_sec['thread_id'];
        
        $thread_user=$rows_sec['thread_user'];
        $query_user= "SELECT username FROM `users_data` WHERE `user_id`= '$thread_user'";
        $sql_user=mysqli_query($conn, $query_user);
        
        $user_row=mysqli_fetch_assoc($sql_user);

        echo '<div style="margin-left:3em; margin-top: 1em; max-width: 90%;">
                <div class="list-group">
                    <a href="thread_detail.php?threadid=' . $rows_sec['thread_id'] . '" class="list-group-item list-group-item-action list-group-item-secondary" aria-current="true">
                        <div class="d-flex">
                            <img src="pictures1/user.png" width="30" height="30"/> 
                            <div style="margin-left:1em">
                            <p class="mb-1">'.$user_row['username'].' at '.$rows_sec['thread_time'].'</p>
                                <div class="d-flex w-90 justify-content-between">
                                    <h5 class="mb-1">'.$rows_sec['thread_title'].'</h5>
                                </div>
                                <p class="mb-1">'.$rows_sec['thread_desc'].'</p>
                            </div>
                            
                        </div>
                    </a>
                </div>
            </div>';
    }
} else {
    echo '<div style="margin:3em 3em;">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" aria-current="true">
                    <div class="d-flex w-70 justify-content-between">
                        <h5 class="mb-1">Nothing asked Yet</h5>
                    </div>
                    <p class="mb-1"></p>
                </a>
            </div>
          </div>';
}
?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>