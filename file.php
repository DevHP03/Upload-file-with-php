<?php
//echo '<pre>';
//var_dump();
//echo '</pre>';
//die();
const IMAGE_TYPE = ['jpeg','png','jpg','JPG'];

if (isset($_POST['send']) && $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
//    var_dump($_FILES['file']);

      $error = '';
      $targetDir = 'uploads/';
      $fileName = $_FILES['file']['name'];
      $file_tmp_name = $_FILES['file']['tmp_name'];
      $file_type = $_FILES['file']['type'];
      $file_size = $_FILES['file']['size'];
      $fileInfo = @getimagesize($_FILES["file"]["tmp_name"]);
      $width = $fileInfo[0];
      $height = $fileInfo[1];
      /**  The validation **/
      if (!in_array($file_type,IMAGE_TYPE)){
          $error = 'The type file is not support.';
      }

      if ($file_size > 2000000){
          $error = 'The size file is bigger than 1.25 kilobyte.';
      }

      if ($width > "300" && $height > "200") {
          $error = 'Your file size should be within bigger than 300<small>x</small>200.' ;
      }
      if (!is_dir($targetDir)){
          mkdir($targetDir);
      }

      if (empty($error)){

      $status = move_uploaded_file($file_tmp_name,$targetDir . $fileName);
      echo 'Success Uploaded';

      }else{


       echo($error);

      }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file_id">
        <input type="submit" value="OK" name="send">
    </form>
</body>
</html>
