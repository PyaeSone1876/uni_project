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
    <title>Register Course</title>
    <style>

        .courseregister-form {
            text-align: center;
            padding: 10px;
            background: skyblue;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .courseregister-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .courseregister-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .courseregister-form button:hover {
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

        
        #items
        {
            width:335px;
            height:35px;
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

        @media (max-width:1035px) {

        header
        {
            padding-right:40rem;
        }

        nav li a
        {
            font-size:12px;
        }

        td
        {
            font-size:12px;
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
        <h1>Register Course</h1>
    </header>
    <main>

        <div class="courseregister-form">
            <h2>Course Register Form</h2>
            <form action="../controller/coursecontroller.php" method="post" enctype="multipart/form-data">
                <label class="form-label">Enter Name</label>
                <br><br>
                <input type="text" name="cname" placeholder="Name" required>
                <br><br>
                <label class="form-label">Enter Description</label>
                <br><br>
                <input type="text" name="cdescription" placeholder="Description" required>
                <br><br>
                <label class="form-label">Enter Price</label>
                <br><br>
                <input type="text" name="cprice" placeholder="Price" required>
                <br><br>
                <label for="image">Upload Image</label>
                <br><br>
                <input type="file" name="image" class="input"></input>
                <br><br>
                <label for="class">Choose Class</label>
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
                <br><br><br><br>
                <button type="submit" name="submit">Submit</button>
                <br><br>
            </form>
        </div>

    </main>
</body>
</html>
<?php
}
?>