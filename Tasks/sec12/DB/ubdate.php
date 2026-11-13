<?php 
session_start();
// require == include but require in error stop page or include in error stop slfe
require "connection.php";
extract($_POST); //name email age gen
extract($_GET); //id

$errors = [];

    // validation
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
        
        $queri = "update users set 
        `name` = '$name' , `email` = '$email' , `age` = '$age' , `gender` = '$gender' 
        where `id` = $id";
        $run = mysqli_query($connection , $queri);
        
        if($run){
            header("location:../home.php");
        }

            
    }else{
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("location:../form_edit.php?id=$id");
        exit();
    }












?>