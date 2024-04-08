<?php
  include_once 'db.php'; 
  $obj = new Database();
  $name = '';
  $email = '';
  $mobile = '';
  $city = '';
  // $obj->pr($_POST);
  if(isset($_POST['submit']) && $_POST['submit'] == 'add'){
    $name = $obj->safe_str($_POST['text_name']);
    $email = $obj->safe_str($_POST['text_email']);
    $mobile = $obj->safe_str($_POST['text_mobile']);
    $city = $obj->safe_str($_POST['text_city']);
    if(!empty($name && $email && $mobile && $city)){
      $arr = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'city'=>$city);
      if($obj->insert_data('student', $arr)){
        header('Location: index.php');
      }
    }
  }
  if(isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0){
    $id = $obj->safe_str($_GET['id']);
    $condition = array('id'=>$id);

    if(isset($_POST['submit']) && $_POST['submit'] == 'edit'){
      $name = $obj->safe_str($_POST['text_name']);
      $email = $obj->safe_str($_POST['text_email']);
      $mobile = $obj->safe_str($_POST['text_mobile']);
      $city = $obj->safe_str($_POST['text_city']);
      if(!empty($name && $email && $mobile && $city)){
        $arr = array('name'=>$name, 'email'=>$email, 'mobile'=>$mobile, 'city'=>$city);
        if($obj->update_data('student', $arr, $condition)){
          header('Location: index.php');
        }
      }
    }

    $res = $obj->select_data('student', $condition);
    $res = $res[0];
    $name = $obj->safe_str($res['name']);
    $email = $obj->safe_str($res['email']);
    $mobile = $obj->safe_str($res['mobile']);
    $city = $obj->safe_str($res['city']);
  }else{
    
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <span class="h1">
              <?php 
                if(isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0){
                  echo "Update Student Data";
                }else{
                  echo "Add Student";
                }
              ?>
            </span>
            <span class="float-end"> <a href="index.php" class="btn btn-primary mt-1">Student Data</a></span>
        </div>
        <form class="m-3" method="POST">
          <div class="my-3">
            <label class="form-label">Name of Student</label>
            <input type="text" class="form-control" name="text_name" value="<?php echo $name ?>" required>
          <div class="my-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="text_email" value="<?php echo $email ?>" required>
          <div class="my-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="text_mobile" value="<?php echo $mobile ?>" required>
          <div class="my-3">
            <label class="form-label">City Name</label>
            <input type="text" class="form-control" name="text_city" value="<?php echo $city ?>" required>
          </div>
          <div class="text-center">
          <?php 
                if(isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0){
                  echo '<button type="submit" class="btn btn-warning me-auto" name="submit" value="edit">Update</button>';
                }else{
                  echo '<button type="submit" class="btn btn-primary" name="submit" value="add">Add Student</button>';
                  ;
                }
              ?>
          </div>
        </form>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>