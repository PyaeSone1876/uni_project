<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location:loginform.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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

        .addstudent-form {
            text-align: center;
            padding: 10px;
            background: skyblue;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .addstudent-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .addstudent-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .addstudent-form button:hover {
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

   .addstudent-form
   {
    margin-left:95px;
    height:990px;
   }

   .attributes
   {
    background:red;
    
   }

   form input[type='text']
   {
    margin-bottom:55px;
   }

   form input[type='file']
   {
    margin-bottom:55px;
   }

   form input[type='password']
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

   .addstudent-form
   {
    margin-left:80px;
    height:995px;
   }

   .attributes
   {
    background:red;
    
   }

   form input[type='text']
   {
    margin-bottom:55px;
   }

   form input[type='file']
   {
    margin-bottom:55px;
   }

   form input[type='password']
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
    <?php include 'navbar.php' ?>
    <header>
        <h1>Add Student</h1>
    </header>
   
    <main>
    <div class="addstudent-form">
            <h2>Add Student Form</h2>
            <form action="../controller/studentcontroller.php" method="post" enctype="multipart/form-data">
                <label class="form-label">Enter User Name</label>
                <br><br>
                <input type="text" name="username" placeholder="Name" required>
                <br><br>
                <label class="form-label">Enter Email</label>
                <br><br>
                <input type="text" name="email" placeholder="Email" required>
                <br><br>
                <label class="form-label">Enter Address</label>
                <br><br>
                <input type="text" name="address" placeholder="Address" required>
                <br><br>
                <label for="phoneno">Phone Number</label>
                <br><br>
                <input type="text" name="phoneno" placeholder="Phone Number" required></input>
                <br><br>
                <label for="password">Password</label>
                <br><br>
                <input type="password" name="password" placeholder="Passsword" required></input>
                <br><br>
                <label for="cpassword">Confirm Password</label>
                <br><br>
                <input type="password" name="cpassword" placeholder="Confirm Password" required></input>
                <br><br>
                <button type="submit" name="addstudent">Add Student</button>
                <br><br>
            </form>
        </div>
    </main>
</body>
</html>
<?php
}
?>
