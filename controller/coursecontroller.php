<?php
include "../connection/connectionDB.php";
if(isset($_POST['submit'])) //submit_button_name
{
    
    $error = array(); //initialize array
    $name = $_POST['cname'];
    $description = $_POST['cdescription'];
    $price = $_POST['cprice'];
    $class=$_POST['classes'];

    $file_name = $_FILES["image"]["name"];
    $file_size = $_FILES["image"]["size"];
    $file_temp = $_FILES["image"]["tmp_name"];
    $file_type = $_FILES["image"]["type"];

    $target_dir = "../image/courses/";
    $target_file = $target_dir.basename($file_name);
    $file_ext = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));
    $ext = array ("png","jpg");

    if(!in_array($file_ext,$ext)) //not_allow_extension
    {
        echo "NOT ALLOW EXTEND";
        $error[]="Not allow extension";
    }
    else if ($file_size>6097152) //not_allow_size
    {
        echo "NOT ALLOW SIZE";
        $error[]= "file size is too long";
    }
    else if (empty($error)==TRUE)
    {
        if (move_uploaded_file($file_temp,$target_file))
        {
            
            $sql = "insert into course(name,description,price,image,class)
            values('$name','$description',$price,'$file_name','$class')";
            $conn->exec($sql);
            header ("location:../admin/ViewCourses.php");
            exit;
        }
    }
} 

if (isset($_POST['update']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $class= $_POST['classes'];
    $id = $_POST['course-id'];
    $old_file_name=$_POST["oldimage"];
    $new_file_name=$_FILES["newimage"]["name"];
    $updateimage;
    if(!empty($new_file_name))
    {
        $updateimage = $new_file_name;
        move_uploaded_file($_FILES["newimage"]["tmp_name"],"../image/courses/".$new_file_name);
    }
    else
    {

        $updateimage=$old_file_name;
        
    }

    $sql = "update course set name='$name',
                    description='$description',
                    price=$price,
                    image='$updateimage',
                    class='$class' where id=$id";
                    $conn->exec($sql);
                    header("location:../admin/viewCourses.php");
                    exit;

}

if (isset($_REQUEST['course_delete_id']))
{
    $id= $_REQUEST['course_delete_id'];
    $sql = "delete from course where id=$id";
    $conn->exec($sql);
    header("location:../admin/ViewCourses.php");
    exit;
}

?>