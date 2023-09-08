<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $id = $_SESSION['id'];
    $sql = "SELECT 
                c.name AS course_name,
                c.class AS class_name,
                c.price AS course_price,
                e.enrollment_date AS enrollment_date,
                s.username AS student_name
            FROM 
                enrollment e
            JOIN 
                course c ON e.course_id = c.id
            JOIN 
                student s ON e.student_id = s.id where s.id=$id;";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
}
table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }

        table
        {
            width:100%;
        }

        .username
        {
            border-radius:10px;
            width:130px;
            padding:10px 5px 10px 5px;
            background:white;
            float:right;
        }
        .icon
        {
            margin-left:5px;
            margin-right:5px;
        }


    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">

    <div class="username"><i class="fa-solid fa-user icon"></i><span class="text"><?php echo $_SESSION["username"]?></span></div>
         <br><br>
        <h1>Enrollment Information of '<span class="uname"><?php echo $_SESSION["username"]?></span>'</h1>
        <br><br>
        <table class="table table-stripped" id="enrollment-tbl">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Enrolled Course</th>
            <th>Price</th>
            <th>Class</th>
            <th>Enrollment Date</th>
        </tr>
<?php
$serial = 1;
 foreach($conn->query($sql)as $key => $row)
 {
?>       
        <tr>
            <td class="attributes" ><?php echo ++$key;?></td>
            <td class="attributes"><?php echo $row['student_name'];?></td>
            <td class="attributes"><?php echo $row['course_name'];?></td>
            <td class="attributes"><?php echo $row['course_price'];?></td>
            <td class="attributes"><?php echo $row['class_name'];?></td>
            <td class="attributes"><?php echo $row['enrollment_date'];?></td>
        </tr>
        <?php
 }
        ?>
        </table>
  <br><br>

        
    </div>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
