<?php 
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old']);

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
        <h3 class="text-center mb-4">Add New User</h3>

        <form action="DB/insert.php" method="post">

            <!-- Name -->
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?= $old['name'] ?? '' ?>" >
                <span class="text-danger"><?= $errors['name'] ?? '' ?></span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email"  value="<?= $old['email'] ?? '' ?>">
                <span class="text-danger"><?= $errors['email'] ?? '' ?></span>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter password" value="<?= $old['password'] ?? '' ?>">
                <span class="text-danger"><?= $errors['password'] ?? '' ?></span>
            </div>

            <!-- Age -->
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="age" class="form-control" placeholder="Enter your age" value="<?= $old['age'] ?? '' ?>">
                <span class="text-danger"><?= $errors['age'] ?? '' ?></span>
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select"  >
                    <option value="">Choose...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <span class="text-danger"><?= $errors['gender'] ?? '' ?></span>
            </div>

            <!-- Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>

        </form>
    </div>

</div>

</body>
</html>