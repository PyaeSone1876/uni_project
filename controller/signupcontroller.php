<?php
require "../connection/connectionDB.php";
    if(!isset($_SESSION)){
        session_start();
    }
     
 
    if(isset($_POST["signup"])) 
    {
        $username=$_POST["username"];
        $email=$_POST["email"];
        $address=$_POST["address"];
        $password=$_POST["password"];
        $phonenumber=$_POST["phnumber"];
        $confirmpassword=$_POST["cpassword"];


        // check whether the password and confirm password 
if($password !== $confirmpassword){
    
    echo "<script>
    alert('Password does not match');
    location.href = '../student/signupForm.php';
    </script>";
     
}
        // insert query 

        $insert_new_register = "INSERT INTO student (username,email,address,phoneno,password) VALUES ('$username', '$email','$address','$phonenumber','$password')";


        // use connection to insert the data into the database
        $conn->query($insert_new_register);
      

        // show the status
        echo "<script>
        alert('Successfully user is registered');
        location.href = '../student/enrollmentForm.php';
        </Script>";

    }