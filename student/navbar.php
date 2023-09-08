<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .logo
    {
        font-size:25px;
        color:orange;
    }

    .brand
    {
        font-size:15px;
        color:red;
        font-family:"Times New Roman";
    }

    .bitems
    {
        text-align:center;
    }

    .nav-links {
        list-style: none;
         display: flex;
         gap: 2px;
         
        }

        nav
        {
            padding-top: 15px;     
        }

        .nav-links a {
           text-decoration: none;
           color: white;

        }

       nav li
       {
        margin-top:10px;
       }

       nav a {
            color:white;
            text-decoration: none;
            padding: 5px 10px;
       } 

        nav a:hover {
            color: black;
            background-color: white;
            border-radius:5px;
       }

       .navbar
       {
        border-radius:10px;
        background-color: black;
       }
   /* iPad Air */
   @media (max-width:820px)  
{
    .nav-links
   {
    width:780px;
   }

   .nav-links li 
   {
    width:250px;
   }

   .nav-links li a
   {
    font-size:10px;
   }

   .navbar
   {
     width:815px;
   }

}
       


</style>
<nav class="navbar">
        <ul class="nav-links">
            <div class="bitems"><i class="fa-brands fa-phoenix-framework logo"></i><p class="brand">Phoenix</p></div>
            <li><a href="enrollmentInformation.php">Enrollment Information</a></li>
            <li><a href="enrollmentForm.php">Enrollment</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="aboutUs.php">About us</a></li>
            <li><a href="course.php">Course</a></li>
            <?php
            if (!isset($_SESSION['id'])) 
            
            {

            ?>
             <li class="nav-item">
                 <a class="nav-link" href="loginForm.php">Login</a>
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
        </ul>
</nav>
