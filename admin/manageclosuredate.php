<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $sql = "select * from date_time";
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
            background: white;
            font-family:"calibri";
        }

    .container {
    padding: 20px;
    width: 25%;
    margin: 0 auto;
    }

    .upperBox{
        box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
        padding: 24px;
        box-sizing: border-box;
        height: auto;
        margin-bottom: 50px;
        border-radius: 10px;
        margin-top: 32px;
    }

    .upperBox h1{
        margin-top: 0px;
        /* text-align: center; */
    }

    form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
}

label {
    font-weight: bold;
}

input[type="datetime-local"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.submitBtn{
    width: 107px;
    height: 40px;
    margin-left: 39%;
    border-radius: 7px;
    border: 1px solid #0B2A54;
    background: white;
    font-size: 17px;
    transition: 0.3s;
    cursor: pointer;
}

.submitBtn:hover{
  background:#0B2A54;
  color:white;
}

button[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

@media (max-width: 1825px) {
            .container {
                width:35%
            }
        }


        @media (max-width: 1415px) {
            .container {
                width:43%
            }
        }

        @media (max-width: 950px) {
            .container {
                width:50%
            }
        }

        @media (max-width: 885px) {
            .container {
                width:70%
            }
        }
     
        /* iPad Air */
        @media (max-width: 820px) {
            .container {
                margin-bottom: 300px;
            }
        }

        @media (max-width: 515px) {
            .container {
                width:90%
            }

            .submitBtn{
                margin-left: 33%;
            }
        }

        .container {
    margin-bottom: auto;
  }
    </style>
</head>
<body>
    <?php
    $_SESSION['location']="mcd"; include 'navbar.php' ?>    
    <div class="container">
        <div class="upperBox">
        <h1>Define Closure Date & Final Closure Date</h1>
    <?php
$serial = 1;
 foreach($conn->query($sql)as $key => $row)
 {
?>       
            <td>Current Closure Date: <strong><p style="color:red;"><?php echo $row['closure_date'];?></p></strong></td>
            <br>
            <td>Current Final Closure Date: <strong><p style="color:red;"><?php echo $row['final_closuredate'];?></p></strong></td>
        <?php
 }
        ?>
        </div>
 <form action="" method="post">
        <label for="closure_date">Closure Date:</label><br><br>
        <input type="datetime-local" id="closure_date" name="closure_date" required><br><br>

        <label for="final_closure_date">Final Closure Date:</label><br><br>
        <input type="datetime-local" id="final_closure_date" name="final_closure_date" required><br><br>

        <input type="submit" class="submitBtn" name="submit" value="Submit">
    </form>
<br><br>
<br><br>
<?php
if (isset($_POST['submit'])) {
    $closure_date = $_POST['closure_date'];
    $final_closure_date = $_POST['final_closure_date'];

    // Format dates as "February 27, 2024, 7:01 pm"
    $formatted_closure_date = date('F j, Y, g:i a', strtotime($closure_date));
    $formatted_final_closure_date = date('F j, Y, g:i a', strtotime($final_closure_date));

    // Check if there is any data in the table
    $stmt = $conn->prepare("SELECT COUNT(*) AS row_count FROM date_time");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row_count = $row['row_count'];

    if ($row_count == 0) {
        // No data exists, perform an insert operation
        $sql = "INSERT INTO date_time (closure_date, final_closuredate) VALUES (:closure_date, :final_closure_date)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':closure_date', $formatted_closure_date);
        $stmt->bindParam(':final_closure_date', $formatted_final_closure_date);
        $stmt->execute();
    } elseif ($row_count == 1) {
        // One row exists, perform an update operation
        $sql = "UPDATE date_time SET closure_date = :closure_date, final_closuredate = :final_closure_date";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':closure_date', $formatted_closure_date);
        $stmt->bindParam(':final_closure_date', $formatted_final_closure_date);
        $stmt->execute();
    }

    // Redirect user after operation
    echo "<script>location.href = '../admin/manageclosuredate.php';</script>";
    exit;
}
?>
    </div>
   <?php include 'footer.php'?>
</body>
</html>
<?php
}

?>
