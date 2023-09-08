<?php  
if (!isset($_SESSION)) {
    session_start();
}

?>

    <nav>
        <ul>
        <li>
            <a href="dashboard.php">Dashboard</a></li>
            <br>
            <li><a href="viewStudents.php">Students</a></li>
            <br>
            <li><a href="viewEnrolledStudents.php">Enrolled Students</a></li>
            <br>
            <li><a href="viewCourses.php">Courses</a></li>
            <br>
            <li><a href="editProfile.php">Profile Settings</a></li>
            <br>
            <?php
            if (!isset($_SESSION['id'])) 
            
            {

            ?>
             <li class="nav-item">
                 <a class="nav-link" href="loginform.php">Login</a>
             </li>
         <?php
            } 
            else 
             {
            ?>

             <li class="nav-item">
                 <a class="nav-link" href="logout.php">Log out</a>
                 
             </li>
         <?php
            }
            ?>
            <br>
             
        </ul>

    </nav>

