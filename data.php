<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    img{
      width:150px;
      height:200px;
    }
  </style>
  </head>
  <body>
    <table border = 10 cellspacing = 0 cellpadding = 8>
      <tr>
        <td>Sl </td>
        <td>Name</td>
        <td>Mobile</td>
        <td>Image</td>
      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM tbb_upload ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["mobile"]; ?></td>


        <td> <img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>"> </td>
        
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    <a href="index.php">Upload Image File</a>
  </body>
</html>