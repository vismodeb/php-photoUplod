<?php

  if(isset($_POST['reg_submit'])){
    $photo = $_FILES['photo'];

    if(empty($photo['name'])){
      $error = 'Photo is Required!';
    }
    else{
      $target_dir = "uploads/";
      $size = $_FILES['photo']['size'];
      $temp_name = $_FILES['photo']['tmp_name'];
      $target_file = $target_dir . basename($_FILES["photo"]["name"]);
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg'){
        $error = 'Photo is must be png or jpg!';
      }
      else if($size >= 10000000){
        $error = 'photo less then 1MB !';
      }
      else{
        $name_prefix = 'vismo_dev_'.rand(99,9999);
        $new_photo_name = $target_dir.$name_prefix.".".$fileType;

        $upload = move_uploaded_file($temp_name, $new_photo_name);
        if($upload == true){
          $success = 'File Upload Successfully!';
        }
        else{
          $error = 'File Upload Failed!';
        }
      }
    }

  }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <div class="form_area">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="card">
              <div class="card-body">
                <h2 class="text-center border-bottom pb-2">Photo uplode</h2>

                <?php if(isset($error)) : ?>
                <div class="alert alert-danger">
                  <?php echo $error; ?>
                </div>
                <?php endif; ?>

                <?php if(isset($success)) : ?>
                <div class="alert alert-success">
                  <?php echo $success; ?>
                </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">

                  <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="profile_photo" name="photo">
                  </div>

                  <button type="submit" name="reg_submit" class="btn btn-primary">Submit</button>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>