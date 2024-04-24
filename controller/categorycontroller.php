<?php
include "../connection/connectionDB.php";
if (isset($_REQUEST['category_delete_id']))
{
    
    $id= $_REQUEST['category_delete_id'];
    echo $id;
    $sql = "delete from category where id=$id";
    $conn->exec($sql);
    header("location:../qamanager/managecategory.php");
    exit;
}

if(isset($_POST['submit']))
{
    $name = $_POST['cname'];
    $description = $_POST['cdescription'];

     
    $sql = "insert into category(name,description)
    values('$name','$description')";
    $conn->exec($sql);
    header ("location:../qamanager/managecategory.php");
    exit;
}
?>