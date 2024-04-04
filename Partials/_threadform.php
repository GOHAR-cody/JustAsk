<?php

include 'db.php';

if(isset($_POST['submit'])){
    
    // Check if the session is started
    if (isset($_SESSION['username'])) {
      
    $ques=$_POST['thread'];
    $desc=$_POST['desc'];
    $cat=$_POST['cat'];
    $id=$_POST['userid'];
    $ques= str_replace("<","&lt;",$ques);
    $ques= str_replace(">","&gt;",$ques);
    $desc= str_replace(">","&gt;",$desc);
    $desc= str_replace(">","&gt;",$desc);
    $sql = "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user`) VALUES ('$ques', '$desc', '$cat', '$id')";
    $query= mysqli_query($conn, $sql);
    
    if($query){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congrats!</strong> Query added sucessfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
}
    else{
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


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Feel free to Ask!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Your Query:</label>
                        <input  type="text" name="thread" class="form-control" id="exampleInputEmail1" required >

                    </div>
                    <input  type="hidden" name="userid" class="form-control" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"  >
                    <div class="mb-3">
                        <label for="cat" class="form-label">Category:</label>
                        <select class="form-select" id="cat" name="cat" aria-label="Default select example" required>
                            <option selected>None</option>
                            <option value="1">Python</option>
                            <option value="2">C++</option>
                            <option value="3">Java</option>
                            <option value="4">C#</option>
                            <option value="5">Clothing</option>
                            <option value="6">Accessories</option>
                            <option value="7">Cosmetics</option>
                            <option value="8">Footware</option>
                        </select>
                    </div>
                    <div class="mb-3">

                        <label for="floatingTextarea2">Further Description:</label>
                        <textarea style="margin-top:7px" name="desc" class="form-control"  id="floatingTextarea2" style="height: 150px"></textarea>


                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-danger">Upload</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
