<?php
require "../connection/connectionDB.php";
    if(!isset($_SESSION)){
        session_start();
    }

 
    if(isset($_POST["enroll"])) 
    {
        $stid = $_SESSION['st_id'];
    
    
        $course = $_POST['cname']; 
        $sql1 = "SELECT * FROM course where name= '$course' ";
        $stmt1 = $conn->query($sql1);
        $row1 = $stmt1->fetch();
        $course_id = $row1['id'];
        
        $enrollment_date=date('y-m-d');
        $dateParts = explode('-', $enrollment_date);
        $enrollment_year=$dateParts[0];
        // echo $student_id ."<br>". $course_id ."<br>";

        $insert_new_register = "insert into webdb.enrollment (student_id,course_id,enrollment_date,enrollment_year) VALUES ('$stid', '$course_id','$enrollment_date','$enrollment_year')";
        echo $insert_new_register;
        $conn->exec($insert_new_register);
      

        // show the status
        echo "<script>
        alert('Student is successfully enrolled!');
        location.href = '../admin/viewEnrolledStudents.php';
        </Script>";

    }

    