<?php 
session_start();
require "DB/connection.php";
extract($_GET);
$queri = "select * from users where `id` = $id";
$run = mysqli_query($connection , $queri);
$user = mysqli_fetch_assoc($run);


$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

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
    
    <div class="card shadow p-4 w-50 mx-auto">
        <h3 class="text-center mb-4">Ubdate User</h3>

        <form action="DB/ubdate.php?id=<?= $id ?>" method="post">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="<?= $user['name'] ?>" class="form-control" placeholder="Enter your name"  >
                <span class="text-danger"><?= $errors['name'] ?? '' ?></span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" placeholder="Enter your email"  >
                <span class="text-danger"><?= $errors['email'] ?? '' ?></span>
            </div>


            <!-- Age -->
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" value="<?= $user['age'] ?>" class="form-control" placeholder="Enter your age"  >
                <span class="text-danger"><?= $errors['age'] ?? '' ?></span>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select"  >
                    <option value="">Choose...</option>
                    <option <?= ($user['gender'] == 'male' ? 'selected' : '') ?> value="male">Male</option>
                    <option <?= ($user['gender'] == 'female' ? 'selected' : '') ?> value="female">Female</option>
                </select>
                <span class="text-danger"><?= $errors['gender'] ?? '' ?></span>
            </div>

            <!-- Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    ubdate
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>