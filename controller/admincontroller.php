<?php
require "../connection/connectionDB.php";
    if(!isset($_SESSION)){
        session_start();
    }
     

if (isset($_POST['update']))
{
    $username=$_POST["username"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $password=$_POST["password"];
    $phonenumber=$_POST["phoneno"];
    $id = $_SESSION['id'];


    $sql= "update admin set username='$username',
                    email='$email',
                    address='$address',
                    phoneno='$phonenumber',
                    password='$password' where id=$id";
                    $conn->exec($sql);
                    echo "<script>
                    alert('Profile is successfully updated!');
                    location.href = '../admin/editProfile.php';
                    </script>";
                    $_SESSION["username"] = $_POST["username"];
                    exit;

}
