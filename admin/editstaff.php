<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
$id = $_REQUEST['id'];
$sql = "select * from staff where id=$id";
$stmt = $conn->query($sql); 
$row = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
         body {
            background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .updatestaff-form {
            text-align: center;
            padding: 10px;
            background:white;
            border-radius:1rem;
            width: 80%; /* Set a relevant width for the form */
            max-width: 400px; /* Limit the maximum width */
            margin: 0 auto; /* Center the form horizontally */
        }

        .updatestaff-form input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .options
        {
            width: 85%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .updatestaff-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .updatestaff-form button:hover {
            background-color: #555;
        }

        /* iPad Air */
        @media (max-width: 820px) {
            .container {
                margin-bottom: 300px;
            }
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ?>    
<div class="container">
<div class="updatestaff-form">
            <h2>Student Edit Form</h2>
            <form action="../controller/staffcontroller.php" method="post" enctype="multipart/form-data">
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
                <label class="form-label">Enter Password</label>
                <br><br>
                <input type="text" name="password" value="<?php echo $row['password']?>">
                <br><br>
                <label class="form-label">Choose: Department</label>
                <br><br>
                <select name="department" id="department" class="options">
                <option value="IT Department" <?php if ($row['department'] == 'IT Department') echo 'selected'; ?>>IT Department</option>
                <option value="Student Department" <?php if ($row['department'] == 'Student Department') echo 'selected'; ?>>Student Department</option>
                <option value="Finance Department" <?php if ($row['department'] == 'Finance Department') echo 'selected'; ?>>Finance Department</option>
                <option value="Customer Service Department" <?php if ($row['department'] == 'Customer Service Department') echo 'selected'; ?>>Customer Service Department</option>
                </select>
                <br><br>
                <br><br>
                <button type="submit" name="update">Update</button>
                <input type="hidden" name="staff-id" value="<?php echo $row ['id']?>">
                <br>
            </form>
            <br><br>
        </div>
</div>


      <br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
