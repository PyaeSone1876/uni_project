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
    <style>
        body {
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    background: white;
    font-family: "calibri";
}

.container {
    padding: 20px;
    width: 50%;
    margin: 0 auto;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
    margin: 40px auto;
    padding-top: 0px;
    border-radius: 10px;
    padding: 0px;
}

.container h1 {
    padding: 21px 0px;
    border-radius: 10px 10px 0px 0px;
    text-align: center;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(148, 148, 148, 0.5);
    width: 95%;
    text-align: center;
    margin-left: 1.5%;
    color: #0a4ba7;
    margin-bottom: 7px;
    margin-top: 0px;
}

.containerBox {
    min-height: 510px;
}

.container input {
    position: absolute;
    top: 194px;
    left: 26.7%;
    width: 115px;
    height: 32px;
    border: 1px solid #4870A6;
    border-radius: 5px;
    background: white;
    color: #1F69CC;
    cursor: pointer;
    font-weight: bold;
    text-transform: capitalize;
    transition: 0.3s;
}

.container input:hover {
    color: white;
    background-color: #4870A6;
}

#category-tbl {
    width: 100%;
    text-align: center;
}

th {
    font-size: 17px;
}

table {
    border-collapse: collapse;
    width: 100%;
    border: none;
}

td {
    /* background: green; */
    color: #505050;
    ;
}

tr:nth-child(even) {
    background: rgba(135, 171, 189, 0.2);
}

table,
th,
td {
    /* border: 2px solid black; */
}

td {
    height: 60px;
}

thead {
    /* box-shadow: 0 5px 10px rgba(82, 82, 82, 0.2); */
    border-radius: 5px;
    color: #0a4ba7;
    height: 50px;
}

tbody {
    height: 50px;
}

a {
    text-decoration: none;

}

.deletebtn
{
    color:red;
}

.btnDelete {
    height: 1rem;
    padding: 0.5rem 1rem 0.5rem 1rem;
    background-color: #0a4ba7;
    color: white;
    border: none;
    border-radius: 5px;
    transition: 0.2s;
    position: relative;
    z-index: 5;
    height: 31px;
    cursor: pointer;
}


.btnDelete:hover {
    background-color: white;
    border: none;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    color: #0a4ba7;
}

@media (max-width:1300px) {
    .container {
        width: 97%;
    }
    .container input {
        left: 4.7%;
    }
}


/* iPad Air */

@media (max-width: 820px) {
    .container h1 {
        font-size: 18px;
        padding-bottom: 43px;
    }
    .container input {
        font-size: 11px;
        top: 218px;
        left: 6.7%;
        width: 85px;
        height: 25px;
    }
}
    </style>
</head>
<body>
    <?php $_SESSION["location"]="manageCat"; include 'navbar.php' ?> 
    
    <div class="containerBox">
    <form action="" method="post">
    <div class="container">
    
    <h1>Manage Category for ideas</h1>

    <input type="submit" value="Add Category" name="addnewcategory"></input>
    
    <?php
    if (isset($_POST['addnewcategory'])) {
       echo "<script>location.href='../qamanager/addcategory.php'</script>";
    }
    ?>
    
    <table class="" id="category-tbl" >
    <thead>
        <tr>
            <th>No.</th>
            <th style="width: 167px;">Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
$serial = 1;

 foreach($conn->query($sql)as $key => $row)
 {
?>   
 
        <div class="table_value">
        <tr>
            <td><?php echo ++$key;?></td>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['description'];?></td>
            <td>
            <button class="btnDelete" value="Delete"><a class="deletebtn" href="../controller/categorycontroller.php?category_delete_id=<?php echo $row['id']?>" onclick="return confirm('Do you want to delete?')">Delete</a></button>
                
            </td>
        </tr>
        </div>

        <?php
 }
        ?>
            </tbody>
            </table>
    </div>

    </div>
    </form>
    </div>
   <?php include 'footer.php'?>
</body>
</html>
<?php
}

?>
