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
        h3{
            color:black !important;
        }
        .main{
            margin-top:4em;
            margin-left:9em
        }
    </style>
</head>
<body>
<?php
include 'Partials/_navbar.php';
include 'db.php';
include 'Partials/_threadform.php';
$query=$_GET['search'];
$sql= "SELECT * FROM `threads` WHERE match (thread_title, thread_desc) against ('$query' )";
$result=mysqli_query($conn, $sql);
$num=mysqli_num_rows($result);
if($num>0){
while($row= mysqli_fetch_assoc( $result)){
    
    $title= $row['thread_title'];
    $desc= $row['thread_desc'];
    $id= $row['thread_id'];
    $url= "thread_detail.php?threadid=".$id;


echo '<div class="container" style=" margin-top:4em">
<h3 class="mb-1 display-6" style=";margin-left:5em;" >Search Results For &nbsp;"<em>'.$_GET['search'].'</em>"</h3>
    <div class="res" style="margin-left:13em;margin-top:2em" >
    <a href="'.$url.'"><h3 class="mb-1">'.$title.'</h3> </a>
    <div >
            <p>'.$desc.'</p>
        </div>
    </div>
</div>
';

}}
else{
    echo'
    <div class="main">
        <div class="container">
            <p class="display-4">No Results Found</p>
            <p class="lead">Suggestions:<ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Search Something else.</li>
                <ul>

            </p>
        </div>
    </div>
    

    ';
}
?>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</body>
</html>
