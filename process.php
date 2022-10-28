<?php


session_start();

$id=0;
$update=false;
$name='';
$location='';


$mysqli=new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));

if(isset($_POST['save'])){
    $name=$_POST['name'];
    $location=$_POST['location'];
    $mysqli->query("INSERT INTO data (name,location) VALUES('$name','$location')") or die($mysqli->error);
    $_SESSION['message']="Record saved successfully";
    $_SESSION['message_type']="success";

    return header("Location:index.php");        
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id='$id'") or die($mysqli->error);
    $_SESSION['message']="Delete successfully";
    $_SESSION['message_type']="danger";
    return header("Location:index.php");    
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $update=true;
    $result=$mysqli->query("SELECT * FROM data WHERE id='$id'") or die($mysqli->error);
    $row=$result->fetch_assoc();
    $name=$row['name'];
    $location=$row['location'];
}

if (isset($_POST['update'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $location=$_POST['location'];
    $mysqli->query("UPDATE data SET name='$name',location='$location' WHERE id='$id'") or die($mysqli->error);
    $_SESSION['message']="update successfully";
    $_SESSION['message_type']="info";
    return header("Location:index.php"); 
}

