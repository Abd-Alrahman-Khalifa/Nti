<?php 
require "connection.php";
$id = $_GET['id'];
$query = "delete from users where `id` = $id";
$run = mysqli_query($connection , $query);
if($run){
    header("location:../home.php");
}




?>