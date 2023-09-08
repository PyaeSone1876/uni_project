<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginform.php');
} else {
include "../connection/connectionDB.php";
$id = $_REQUEST['id'];
$sql = "select * from student where id=$id";
$stmt = $conn->query($sql); 
$row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>

        .updatestudent-form {
            text-align: center;
            padding: 10px;
            background: skyblue;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .updatestudent-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .updatestudent-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .updatestudent-form button:hover {
            background-color: #555;
        }

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

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            grid-area: footer;
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

   form input[type='file']
   {
    margin-bottom:60px;
   }

   form select
   {
    margin-bottom:50px;
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

   form input[type='file']
   {
    margin-bottom:60px;
   }

   form select
   {
    margin-bottom:50px;
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
    <?php include 'navbar.php'?>
    <header>
        <h1>Edit Student</h1>
    </header>
    <main>
        <div class="updatestudent-form">
            <h2>Student Edit Form</h2>
            <form action="../controller/studentcontroller.php" method="post" enctype="multipart/form-data">
                <label class="form-label">Enter Name</label>
                <br><br>
                <input type="text" name="username" value="<?php echo $row['username']?>">
                <br><br>
                <label class="form-label">Enter Email</label>
                <br><br>
                <input type="text" name="email" value="<?php echo $row['email']?>">
                <br><br>
                <label class="form-label">Enter Address</label>
                <br><br>
                <input type="text" name="address" value="<?php echo $row['address']?>">
                <br><br>
                <label class="form-label">Enter Phone Number</label>
                <br><br>
                <input type="text" name="phoneno" value="<?php echo $row['phoneno']?>">
                <br><br>
                <label class="form-label">Enter Password</label>
                <br><br>
                <input type="text" name="password" value="<?php echo $row['password']?>">
                <br><br>
                <button type="submit" name="update">Update</button>
                <input type="hidden" name="student-id" value="<?php echo $row ['id']?>">
            </form>
        </div>
    </main>
</body>
</html>
<?php
}
?>