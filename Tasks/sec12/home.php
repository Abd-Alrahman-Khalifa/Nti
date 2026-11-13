<?php 
// $connection = mysqli_connect("localhost" , "root" , "" , "gpt" , 3307);
require "DB/connection.php";
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $query = "select * from users where `name` like '$name%' ";
}else{
    $query = "select * from users";

}
$run = mysqli_query($connection , $query);
$users = mysqli_fetch_all($run , MYSQLI_ASSOC);
// echo "<pre>";
// print_r($users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">

    <div class="text-center mb-4 ">
        <a href="form.php" class="btn btn-success btn-lg me-3">
            + Add New User
        </a>
        <a href="home.php" class="btn btn-dark btn-lg">
            Show All Users
        </a>
    </div>
    
    <div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form method="post" action="home.php">
        <div class="input-group shadow rounded overflow-hidden">
          <input 
            type="text" 
            name="name"
            class="form-control border-0" 
            placeholder="search 🔍"         >
          <button class="btn btn-dark">Search</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $key => $val){ ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $val['name'] ?></td>
                    <td><?= $val['email'] ?></td>
                    <td><?= $val['gender'] ?></td>
                    <td><?= $val['age'] ?></td>

                    <td>
                        <a class="btn btn-warning btn-sm" href="form_edit.php?id=<?= $val['id'] ?>">
                            Edit
                        </a>

                        <a 
                            href="DB/delet.php?id=<?= $val['id'] ?>"
                            class="btn btn-danger btn-sm">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>

</div>
    
</body>
</html>