<?php
  if(!isset($_SESSION))
  {
      session_start();
  
  }
if (!isset($_SESSION['id'])) {
  header('location:loginform.php');
}
else
{
    include '../connection/connectionDB.php';
    $sql = "SELECT * FROM course";
    $results = $conn->query($sql);
    $sname="";
    if(isset($_POST["btnsearch"]))
{
    $sname=$_POST['search'];
    $sql="SELECT * FROM course where name like '%$sname%'";
    $results= $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
}

.row .col{

width: 235px;
height:400px;
margin-left:1rem;
margin-top:1rem;
display: inline-block;
align-items:center;
justify-content: center;
background:grey;
color:black;
padding-left:1rem;
padding-top:2rem;
padding-right:0.5rem;
border:solid 1px;
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
border-radius:2rem;
}
.img-thumbnail
    
    {
        border:solid 1px;
        border-radius:5px;
        margin-left:10px;
    }

    .container
    {
        width:1140px;
        margin:0 auto;
    }
  

    .info
    {
        height:80px;
    }

    .buttons
    {
        text-align:center;
    }

    .search
    {
        display:flex;
        padding-left:15px;
        border-radius:5px;
        border:none;
    }

    #buttons
        {
            border-radius:5px;
            margin-left:5px;
            width:5rem;
            height:1.5rem;
            border:none;
            color:white;
            background:black;
        }

        #buttons:hover 
        {
            cursor:pointer;
            color:black;
            background:white;
        }




.viewdetail
{
padding:10px 40px 10px 40px;
border:none;
background-color:white;
color:black;
border-radius: 5px;
box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
text-decoration:none;
}

.viewdetail:hover
{
background-color:black;
color:white;
}

   /* iPad Air */
@media (max-width:820px)  
{

   .container
    {
        
       margin-bottom:200px;


    }

    .carddiv
    {
        width:570px;
    }

   .container
   {
    width:570px;
   }

   

}

</style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
<div class="row">
<form action="" method="post">
<div class="search">
<input type="text" name="search" value="<?php echo $sname; ?>" class="search" placeholder="Search course name ....">
    <div class="input-group-append">
        <button class="buttons" type="submit" name="btnsearch" id="buttons">Search</button>
        <button class="buttons" type="submit" name="btnshowall" id="buttons">Show All</button>
</div>
</form>
    </div>
    <br><br>
            <div class="carddiv">
            <?php
            foreach ($conn->query($sql) as $row) {
            ?>
                <div class="col">
                    <form action="../controller/coursecontroller.php" method="post" class="view-product-cart-from">
                        <div>
                            <img src="../image/courses/<?php echo $row['image'] ?>" width="200px" height="200px" class="img-thumbnail">
                        </div>
                        <br>
                        <div class="info">
                            <span>Name: <?php echo $row['name'] ?></span>
                            <br>
                            <span>Price (Dollar): <?php echo $row['price'] ?></span>
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">                 
                            <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
                            <input type="hidden" name="price" value="<?php echo $row['price'] ?>">
                            <br><br><br>
                           <div class="buttons">
                            <a href="coursedetail.php?view_course=<?php echo $row['id'] ?>" class="viewdetail"> View Detail</a>
                           </div>
                        </div>

                    </form>

                </div>
            <?php

            }
            ?>
            </div>
            
        </div>
</div>
<br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
