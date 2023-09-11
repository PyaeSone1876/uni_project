<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
        include "../connection/connectionDB.php";
        $id=$_SESSION['id'];
        $sql ="select * from student where id='$id'";
        $sql1 ="select * from course";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
}

.contactform{
       padding:5rem;
       width:24.5rem;
       margin:0 auto;
       background:black;
       color:white;
       align-items:center;
       box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       border-radius:25px;
       
    }

    textarea
    {
        resize: none;
    }

   .contentitems
    {
        text-align:center;
    }

    form input[type="text"]
    {
        width:240px;
    }

    form input[type="email"]
    {
        width:240px;
    }

    .btnsend
    {
        background:white;
        color:black;
        border:none;
        border-radius:5px;
        padding:5px 10px 5px 10px;
    }

    .btnsend:hover
    {
        background:grey;
    }
    .text
       {
           text-align:center;
       }

       .title
       {
        text-align:center;
       }

@media (max-width:820px)  
{
  
    .container
    {
        margin-bottom:300px;
    }

}


    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
<center><h1>Contact Form</h1></center>
        <br><br>
    <form action="mailto:phoenixenglish.school@gmail.com" method="post" enctype="text/plain" class="contactform">
   <div class="contentitems">
   <label for="name">Name</label>
    <br><br>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="email">Email:</label>
    <br><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="message">Write the Message:</label>
    <br><br>
    <textarea id="messagebox" name="message" rows="4" cols="30" required></textarea><br><br>
    
   </div>
   <button value="Send" class="btnsend">Send</button>
  </form>
</div>
<br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
