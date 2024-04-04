<?php 
include 'db.php';
$newid=$_GET['threadid'];

// Start the session
session_start();

if(isset($_POST['submit_ans'])){
    // Check if the session is set
    if (isset($_SESSION['username'])) {
        $reply_user_id= $_POST['reply_user_id'];
        $answer= $_POST['ans'];
        $answer= str_replace("<","&lt;",$answer);
        $answer= str_replace(">","&gt;",$answer);
        $query= "INSERT INTO `replies`(`reply_desc`,`reply_thread_id`, `reply_user`) VALUES ('$answer','$newid','$reply_user_id') ";
        $sql= mysqli_query($conn, $query);
        if($sql){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Congrats!</strong> Query added sucessfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    else{
        // Redirect to login page if session is not set
        header("Location: login.php");
        exit;
    }
}
?>
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
include 'Partials/_threadform.php';

$sql_thread = "SELECT * FROM `threads` WHERE `thread_id`= '$newid'";
$query_thread= mysqli_query($conn,$sql_thread);

$rows_thread= mysqli_fetch_assoc($query_thread);
$thread_user=$rows_thread['thread_user'];
$query_thread_user= "SELECT username FROM `users_data` WHERE `user_id`= '$thread_user'";
$sql_thread_user= mysqli_query($conn,$query_thread_user);
$user=mysqli_fetch_assoc($sql_thread_user);

echo '<div style="margin:5em">
<div style="display:flex">
<h1>'.$rows_thread['thread_title']. ' </h1>
<p style="font-size:18px; margin-left:0.5em;color:grey;position:relative; top:1em  "><i>Posted by '.$user['username'].'</i></p>
</div>

<p style="margin:1em 2em; min-height:100px; ">'.$rows_thread['thread_desc'].'</p>'
;

?>
<form Method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div>
        
        <label style="font-weight:500; font-size:25px" for="exampleInputEmail1" class="form-label">What Do You Think?</label>
        <textarea style="max-width:1000px; min-height:200px; border:3px solid grey" name="ans" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
        <input type="hidden" name="reply_user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>" />

        <div id="emailHelp" class="form-text">Assist a fellow friend</div>
        <button style="margin-left:55em; margin-bottom:3em;" name="submit_ans" type="submit" class="btn btn-dark">Submit</button>
    </div>
</form>
<h1 style=""> Discussions:</h1>
<?php 
$query_reply = "SELECT * FROM `replies` WHERE `reply_thread_id`= $newid";
$sql_reply= mysqli_query($conn,$query_reply);
$num= mysqli_num_rows($sql_reply);
if($num > 0){
    while($rows_reply= mysqli_fetch_assoc($sql_reply)){
        $num= mysqli_num_rows($sql_reply);
        $reply_user= $rows_reply['reply_user'];
        $query_user= "SELECT username FROM `users_data` WHERE `user_id`= '$reply_user'";
        $sql_user=mysqli_query($conn, $query_user);
        $user_row=mysqli_fetch_assoc($sql_user);
        $reply_id= $rows_reply['reply_id'];
        echo '<div class="d-flex " style="margin-top:1em; padding:1em" >
                <img src="pictures1/user.png" width="30" height="30"/> 
                <div style="margin-left:1em">
                    <p>'.$user_row['username'].' &nbsp;'.$rows_reply['time'].'</p>
                    <div class="d-flex w-90 justify-content-between" >
                        <p class="mb-1">'.$rows_reply['reply_desc'].'</p>
                    </div>
                </div>
            </div>';
    }
}
else{
    echo '<div style="margin:3em 3em;">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action list-group-item-secondary" aria-current="true">
                    <div class="d-flex w-70 justify-content-between">
                        <h5 class="mb-1">No Answers Yet!</h5>
                    </div>
                    <p class="mb-1"></p>
                </a>
            </div>
        </div>';
}
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
