<?php
require "../connection/connectionDB.php";
    if(!isset($_SESSION)){
        session_start();
    }
    $stname = $_POST['sname']; 
    $sql = "SELECT * FROM student where username= '$stname' ";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch();
    $stid = $row['id'];


    $course = $_POST['cname']; 
    $sql1 = "SELECT * FROM course where name= '$course' ";
    $stmt1 = $conn->query($sql1);
    $row1 = $stmt1->fetch();
    $course_id = $row1['id'];
 
    if(isset($_POST["enroll"])) 
    {
        
        $enrollment_date=date('y-m-d');
        $dateParts = explode('-', $enrollment_date);
        $enrollment_year=$dateParts[0];
        // echo $student_id ."<br>". $course_id ."<br>";

        $insert_new_register = "insert into webdb.enrollment (student_id,course_id,enrollment_date,enrollment_year) VALUES ('$stid', '$course_id','$enrollment_date','$enrollment_year')";
        $conn->exec($insert_new_register);
      

        // show the status
        echo "<script>
        alert('Student is successfully enrolled!');
        location.href = '../student/enrollmentForm.php';
        </Script>";

    }