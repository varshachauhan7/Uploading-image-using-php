<?php
require 'connection.php';
if(isset($_POST["submit"])){
  $name = $_POST["name"];
  $mobile = $_POST["mobile"];
  if($_FILES["image"]["error"] == 4){
    echo
    "<script> alert('Image Does Not Exist'); </script>"
    ;
  }
  else{
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    if ( !in_array($imageExtension, $validImageExtension) ){
      echo
      "
      <script>
        alert('Invalid Image Extension');
      </script>
      ";
    }
    else if($fileSize > 1000000){
      echo
      "
      <script>
        alert('Image Size Is Too Large');
      </script>
      ";
    }
    else{
      $newImageName = uniqid();
      $newImageName .= '.' . $imageExtension;

      move_uploaded_file($tmpName, 'img/' . $newImageName);
      $query = "INSERT INTO tbb_upload VALUES('', '$name', '$mobile','$newImageName')";
      mysqli_query($conn, $query);
      echo
      "
      <script>
        alert('Successfully Added');
        document.location.href = 'data.php';
      </script>
      ";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Upload Image File</title>
  
  </head>
  <body>
  <h1 class="text-center my-3">Registration form</h1>
    <div class="container d-flex justify-content-center">
        <form action=""  method="post" class="w-50" enctype="multipart/form-data" >
             <div class="frm-group my-4">
                <input type="text" name="name" Placeholder="Username" class="form-control">
            </div>

            <div class="form-group my-4">
                <input type="text" name="mobile" Placeholder="Mobile" class="form-control">
            </div>
        
            <div class="form-group my-4">
                <input type="file" name="image" Placeholder="" class="form-control" accept=".jpg, .jpeg, .png" value="">
            </div>

         <button class="btn btn-dark my-4" type="submit" name="submit">Submit</button>
         <button class="btn btn-primary my-4"><a href="data.php" class="text-light">Data</button>
        </form>
    <br>
    
  </body>
</html>