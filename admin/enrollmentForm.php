<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location:loginform.php');
} else {
    include "../connection/connectionDB.php";
    $sid="";
    $sql="SELECT * FROM student";
    if(isset($_POST["btnsearch"]))
    {
        $sid=$_POST['search'];
        $sql="SELECT * FROM student where id like '%$sid%'";
        $results= $conn->query($sql);
    }

    $sql1 = "select * from course";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: 20% 80%;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "nav header"
                "nav main"
                "nav footer";
            min-height: 100vh;
            background:wheat;
        }

        .enrollment-form {
            text-align: center;
            padding: 10px;
            background: skyblue;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .enrollment-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .enrollment-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .enrollment-form button:hover {
            background-color: #555;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            grid-area: header;
        }

        nav {
            background-color: black;
            padding: 10px;
            grid-area: nav;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            height:120vh;
        }

        

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav a:hover {
            color: black;
            background-color: white;
        }

        nav li {
            margin: 5px 0;
        }

        main {
            padding: 20px;
            grid-area: main;
            font-size: 16px; /* Default font size */
        }

        #items
        {
            width:335px;
            height:35px;
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            grid-area: footer;
        }

        .course
        {
            width:340px;
            height:35px;
        }
      

/* iPad Air */
@media (max-width:821px)  
{
   nav li a
   {
    font-size:15px;
    margin-bottom:100px;
   }

   nav li 
   {
    margin-top:10px;
   }
   
   nav 
   {
    width:150px;
   }

   .updatestudent-form
   {
    margin-left:95px;
    height:900px;
   }


   form input[type='text']
   {
    margin-bottom:60px;
   }


}

/* iPad Mini */
@media (max-width:769px)  
{
   header
   {
     margin-left:15px;
   }
   nav li a
   {
    font-size:15px;
    margin-bottom:100px;
   }

   nav li 
   {
    margin-top:10px;
   }
   
   nav 
   {
    width:150px;
   }

   .updatestudent-form
   {
    margin-left:80px;
    height:900px;
   }

   form input[type='text']
   {
    margin-bottom:60px;
   }




}
@media screen and (min-width: 1024px) {
    header,
    nav,
    main,
    footer {
        padding: 30px;
    }
}


    </style>
</head>
<body>
    <?php include 'navbar.php' ?>
    <header>
        <h1>Enrollment</h1>
    </header>
   
    <main>
    <div class="enrollment-form">
            <h2>Enrollment Form</h2>
            <form action="" method="post">
            <input type="text" name="search" value="<?php echo $sid; ?>" class="search" placeholder="Search student id ..." style="width:10rem;">
            <button class="buttons" type="submit" name="btnsearch" id="buttons" style="width:3rem;"><i class="fa-solid fa-magnifying-glass"></i></button>

            </form>
            <form action="../controller/enrollmentcontroller.php" method="post" enctype="multipart/form-data">

                <br><br>
      <?php 
      if (isset($_POST['btnsearch']) && $sid !== "")
      {
        $_SESSION['st_id']=$sid;
        ?>
                <label class="form-label">Student name:</label>
                <br><br>
                <?php
                foreach ($conn->query($sql) as $row) {
                ?>
                <input type="text" name="sname" value="<?php echo $row['username'] ?>" readonly>
                <?php
                }
                ?>                    
                <br><br>
                <label for="form-label">Choose Course:</label>
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
                <button name="enroll" value="submit" class="submitbtn">Enroll</button>
                
                <br><br>
                <?php
      }
      ?>
            </form>
        </div>
    </main>
</body>
</html>
<?php
}

?>
