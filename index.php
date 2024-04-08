<?php
  include_once 'db.php';
  $obj = new Database();
  $result = $obj->select_data('student');
  // echo "<pre>";
  // print_r($result);

  if(isset($_GET['type']) && $_GET['type']=='del' && isset($_GET['id']) && $_GET['id']!='' && $_GET['id']>0){
    $id = $obj->safe_str($_GET['id']);
    $condition = array('id'=>$id);
    if($obj->delete_data('student', $condition)){
      header('Location: index.php');
    }
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
            <span class="h1">Students Data</span>
            <span class="float-end"> <a href="manage.php" class="btn btn-primary mt-1">Add New Student</a></span>
        </div>
    </div>
<table class="table table-bordered text-center">
  <thead class="table-warning">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile</th>
      <th scope="col">City</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    ?>
      <?php 
      if(!empty($result)){
        $c = 1;
        foreach($result as $student){ ?>
          <tr>
          <th scope="row"><?php echo $c++ ?></th>
          <td><?php echo $student['name'] ?></td>
          <td><?php echo $student['email'] ?></td>
          <td><?php echo $student['mobile'] ?></td>
          <td><?php echo $student['city'] ?></td>
          <td><a href="manage.php?id=<?php echo $student['id']?>" class="btn btn-warning btn-sm" >Edit</a></td>
          <td><a href="?type=del&id=<?php echo $student['id']?>" class="btn btn-danger btn-sm" >Delete</a></td>
          <!-- <td class="btn btn-primary my-2">Edit</td> -->
        </tr>
        <?php
        }
      }else{
        ?>
        <tr>
          <th scope="row"><?php echo "No Records Found" ?></th>
        </tr>
      <?php } ?>
        
  </tbody>
</table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>