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
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
}

.enrollment-form {
            text-align: center;
            padding: 10px;
            background:black;
            color:white;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin:0 auto ; 
            align-items:center;
            margin-top:3rem;
        }

        .enrollment-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .enrollment-form button {
            width: 50%;
            padding: 10px;
            background-color:white;
            color:black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }



        .enrollment-form button:hover {
            background-color:grey;
            cursor:pointer;
        }

        .enrollform
        {
            text-align:center;
        }

        .enrolltitle
        {
            text-align:center;
        }

        .course
        {
            width:340px;
            height:35px;
        }


/* iPad Air */
  @media (max-width:821px)  
{
   
   .container
   {
    margin-bottom:470px;
   }
   
}

    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
    <h1 class="enrolltitle">Enrollment Form</h1>
<div class="enrollment-form">
        
        <form action="../controller/studentenrollmentcontroller.php" method="post" enctype="multipart/form-data">
          <br><br>                
            <label class="student_name">Student Name</label>
            <br><br>
            <?php
            foreach ($conn->query($sql) as $row) {
            ?>
            <input type="text" value="<?php echo $row['username']?>" name="sname" readonly>
            <?php
            }
            ?>
            </select>
            <br><br>
            <label for="form-label">Choose Course</label>
            <br><br>

            <select name="cname" id="cname" class="course">
            <?php
            foreach ($conn->query($sql1) as $row1) {
            ?>
            <option><?php echo $row1['name'] ?></option>
            > 
            <?php
            }
            ?>     
            </select>
            <br><br>
            <button name="enroll" value="submit" class="submitbtn" onclick="return confirm('Are you sure to enroll?')">Enroll</button>
            
            <br><br>
        </form>
    </div>
</div>
<br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
