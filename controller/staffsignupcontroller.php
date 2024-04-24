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
        $confirmpassword=$_POST["cpassword"];
        $department = $_POST["department"];
        

  
if($password !== $confirmpassword){
    
    $_SESSION['al_msg'] = array('type' => 'Invalid', 'header' =>'Invalid', 'body'=>"Password does not match");

    echo "<script>
    location.href = '../staff/signupForm.php';
    </script>";
     
}
  

        $insert_new_register = "INSERT INTO staff (username,email,address,password,department,agreement) VALUES ('$username', '$email','$address','$password','$department','no')";


        $conn->query($insert_new_register);
      

        $_SESSION['al_msg'] = array('type' => 'Info', 'header' =>'Information', 'body'=>"Successfully user is registered");

        echo "<script>
        location.href = '../staff/feed.php';
        </Script>";

    }