<?php 
session_start();
require "connection.php";
$errors = [];
$old = [];
$old['name'] = $_POST['name'];
$old['email'] = $_POST['email'];
$old['age'] = $_POST['age'];
$old['gender'] = $_POST['gender'];

if($_SERVER['REQUEST_METHOD'] == "GET"){
    header('location:../form.php');
}else{
    // validation
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    if(empty($name)){
        $errors['name'] = 'name is requird';
    }elseif(strlen($name) < 3){
        $errors['name'] = 'name is not valide';
    }elseif(!preg_match('/^[a-zA-Z]+$/' , $name)){
        $errors['name'] = 'name is not valide';
    }

    if(empty($email)){
        $errors['email'] = 'email is requird';
    }elseif(!filter_var($email , FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'email is not valid';
    }

    if (!preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/', $password)) {
        $errors['password']= "Password must contain capital, number, and 8 chars";
    }
    
    if(empty($age)){
        $errors['age'] = 'age is requird';
    }elseif($age < 15 || $age > 99){
        $errors['age'] = 'age is not valid';
    }elseif(!is_numeric($age)){
        $errors['age'] = 'age must be Number' ;
    }

    if(empty($gender)){
        $errors['gender'] = 'gender is requird';
    }

    if(empty($errors)){
        // database
        // extract($_POST);
        $select_query = "select * from users where `email` = '$email'";
        $select_run = mysqli_query($connection , $select_query);
        $user_row = mysqli_num_rows($select_run);
        
        if($user_row == 0){
            // to connect database have 3 step 
            // connection  quiry  run
            
            // 1- connection  (hostname , username , password , dbname , port if change 3306)
            // $connection = mysqli_connect("localhost" , "root" , "" , "gpt" , 3307); == 
            
            // md5 encreption decrption  not safe 
            // لو الباسورد متشابهه هتطلع نفس النتيجه بتاعت التشفير
            // $password = md5($password);
            
            // hash encreption only 
            //  لو الباسورد متشابهه  هتطلع النتيجه بتاعت التشفير مختلفه
            $password = password_hash($password , PASSWORD_DEFAULT);
            // password_verify() بتقارن
            
            $query = "insert into users 
            (`name` , `email` , `password` , `gender` , `age`) 
            values
            ('$name' , '$email' , '$password' , '$gender' , '$age')";
            
            $run = mysqli_query($connection , $query );
            
            if($run){
                header("location:../home.php");
            }
            
        }else{
            $errors['email'] = "email already existes";
            $_SESSION['errors'] = $errors;
            header("location:../form.php");
            // echo "tish email already exist";
        }
    }else{
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("location:../form.php");
        exit();
    }







}







?>