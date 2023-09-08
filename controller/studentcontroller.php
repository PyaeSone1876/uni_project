<?php
require "../connection/connectionDB.php";
    if(!isset($_SESSION)){
        session_start();
    }
     
 
    if(isset($_POST["addstudent"])) 
    {
        $username=$_POST["username"];
        $email=$_POST["email"];
        $address=$_POST["address"];
        $password=$_POST["password"];
        $phonenumber=$_POST["phoneno"];
        $confirmpassword=$_POST["cpassword"];


        // check whether the password and confirm password 
if($password !== $confirmpassword){
    
    echo "<script>
    alert('Password does not match');
    location.href = '../admin/insertStudents.php';
    </Script>";
     
}
        // insert query 

        $insert_new_register = "INSERT INTO student (username,email,address,phoneno,password) VALUES ('$username','$email','$address','$phonenumber','$password')";


        // use connection to insert the data into the database
        $conn->query($insert_new_register);
      

        // show the status
        echo "<script>
        alert('Successfully student is registered');
        location.href = '../admin/viewStudents.php';
        </Script>";

    }

if (isset($_POST['update']))
{
    $username=$_POST["username"];
    $email=$_POST["email"];
    $address=$_POST["address"];
    $password=$_POST["password"];
    $phonenumber=$_POST["phoneno"];
    $id = $_POST['student-id'];


    $sql= "update student set username='$username',
                    email='$email',
                    address='$address',
                    phoneno='$phonenumber',
                    password='$password' where id=$id";
                    $conn->exec($sql);
                    header("location:../admin/viewStudents.php");
                    exit;

}
