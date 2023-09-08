<?php
if (!isset($_SESSION)) {
    session_start();
}
 if(isset($_GET["view_course"])) //submit
    {
        $id=$_GET['view_course'];
    }
    include "../connection/connectionDB.php";
    $sql = "select * from course WHERE id = $id";
    
  $dataset =  $conn->query($sql);
  $data = $dataset->fetch();
  $img = $data['image'];
  $name=$data['name'];
  $description = $data['description'];
  $price=$data['price'];
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
}

.courseimage img
       {
         width:400px;
         height:400px; 
         border-radius:15px; 
       }

       .container
       {
        display:flex;
       }
       .courseimage
       {
        width:50%;
       }

       .product_info
       {
        width:50%;
       }

       .name,.description,.price,.class
       {
        display:flex;
        width:100%;
       }

       .cname,.cdescription,.cprice,.cclass
       {
        width:50%;
       }

       .attributes
       {
        width:50%;
       }



    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
<div class="courseimage">
    <img src="../image/courses/<?php echo $img ?>" >
    </div>

    <div class="product_info">
    <h1>Product's Information</h1>
       <br><br> 
       <div class="name">
       <p class="cname">Course Name: </p>
       <p class="attributes"> <?php echo $name?>
       </div>
       <br><br> 
        <div class="description">
        <p class="cdescription">Description: </p>
       <p class="attributes"><?php echo $description?> </p>
        </div>
        <br><br> 
       <div class="price">
       <p class="cprice"> Price (Dollar): </p>
        <p class="attributes"><?php echo $price?> </p>
       </div>
       <br><br> 

    </div>
</div>
<br><br>
    <?php include 'footer.php' ?>
</body>
</html>

