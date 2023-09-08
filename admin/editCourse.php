<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('location:loginform.php');
} else {
    include "../connection/connectionDB.php";
    $id = $_REQUEST['id'];
    $sql = "select * from course where id=$id";
    $stmt = $conn->query($sql); 
    $row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>

        .courseupdate-form {
            text-align: center;
            padding: 10px;
            background: skyblue;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .title
        {
            font-size:2rem;
            font-weight:bold;
        }

        .courseupdate-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius:5px;
        }

        .courseupdate-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .courseupdate-form button:hover {
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

        .classes
        {
            width:340px;
            height:35px;
        }

/* iPad Air */
@media (max-width:821px)  
{
   header
   {
    margin-left:5px;
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

   .courseupdate-form
   {
    margin-left:95px;
    height:900px;
   }

   .attributes
   {
    background:red;
    
   }

   form input[type='text']
   {
    margin-bottom:70px;
   }

   form input[type='file']
   {
    margin-bottom:70px;
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
     margin-left:17px;
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

   .courseupdate-form
   {
    margin-left:80px;
    height:900px;
   }

   .attributes
   {
    background:red;
    
   }

   form input[type='text']
   {
    margin-bottom:70px;
   }

   form input[type='file']
   {
    margin-bottom:70px;
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
        <h1>Edit Course</h1>
    </header>
    <main>
        <div class="courseupdate-form">
            <h2>Course Edit Form</h2>
           
           <form action="../controller/coursecontroller.php" method="post" enctype="multipart/form-data">

                <label class="form-label">Enter Name</label>
                <br><br>
                <input type="text" name="name" value="<?php echo $row['name']?>">
                <br><br>
                <label class="form-label">Enter Description</label>
                <br><br>
                <input type="text" name="description" value="<?php echo $row['description']?>">
                <br><br>
                <label class="form-label">Enter Price</label>
                <br><br>
                <input type="text" name="price" value="<?php echo $row['price']?>">
                <br><br>
                <label for="image">Upload Image: </label>
                <br><br>
                <input type="file" name="newimage" class="input"></input>
                <br><br>
                <label for="class" class="classes">Choose Class: </label>
                <br><br>
                <select name="classes" id="classes" class="classes">
                <option value="Room A">Room A</option>
                <option value="Room B">Room B</option>
                <option value="Room C">Room C</option>
                <option value="Room D">Room D</option>
                <option value="Room E">Room E</option>
                <option value="Room F">Room F</option>
                <option value="Room G">Room G</option>
                <option value="Room H">Room H</option>
                <option value="Room I">Room I</option>
                <option value="Room J">Room J</option>
                <option value="Room J">Room K</option>
                <option value="Room J">Room L</option>
                
                </select>
                <br><br>
                <input type="hidden" name="oldimage" value="<?php echo $row['image']?>">
                <input type="hidden" name="course-id" value="<?php echo $row ['id']?>">
                <button type="submit" name="update">Update</button>
           
            </form>
         
        </div>
    </main>
</body>
</html>
<?php
}
?>