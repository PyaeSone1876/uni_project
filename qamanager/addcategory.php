<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $sql = "select * from category";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<style>
    body {
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    background: white;
    font-family: "calibri";
}

h1 {
    text-align: center;
    text-align: center;
    margin-bottom: 29px;
    color: #14396C;
    text-transform: uppercase;
}

.container {
    padding: 20px;
    width: 23%;
    margin: 0 auto;
}

input[type="text"]:focus {
    outline: none;
    border: 1px solid lightblue
}

form {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
    background: white;
}

label {
    font-weight: bold;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    /* Ensures the padding and border are included in the element's total width and height */
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    margin-left: 39.3%;
}

input[type="submit"]:hover {
    background-color: #45a049;
}


/* iPad Air */
@media (max-width: 1250px) {
    .container {
        width: 35%;
    }
}


@media (max-width: 900px) {
    .container {
        width: 46%;
    }
}

@media (max-width: 600px) {
    .container {
        width: 70%;
    }
}
</style>
<body>
    <?php include 'navbar.php' ?>    
    <br><br>
    <div class="container">
        <h1>Add Category Form</h1>
    <form action="../controller/categorycontroller.php" method="post">
        <label for="category name">Category Name:</label><br><br>
        <input type="text" id="cname" name="cname" placeholder="Category here..."><br><br>

        <label for="category description">Description:</label><br><br>
        <input type="text" id="cdescription" name="cdescription" placeholder="Description here..."><br><br>

        <input type="submit" value="Submit" name="submit">
    </form>
</div>
<br><br>
<br><br>
<br><br>
   <?php include 'footer.php'?>
</body>
</html>
<?php
}

?>
