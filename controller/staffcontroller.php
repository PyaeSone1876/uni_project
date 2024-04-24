<?php

if(!isset($_SESSION)){
    session_start();
}
require "../connection/connectionDB.php";

if (isset($_POST['update']))
{
    $username=$_POST["username"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $password=$_POST["password"];
    $department=$_POST["department"];
    $id = $_POST['staff-id'];



    $sql= "update staff set username='$username',
                    email='$email',
                    address='$address',
                    password='$password',
                    department='$department' where id=$id";
                    $conn->exec($sql);
                    header("location:../admin/systeminfo.php");
                    exit;

}
?>