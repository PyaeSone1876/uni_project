<?php

include '../connection/connectionDB.php';

$id = $_GET['id'];

$sql = "delete from students where id='$id'";

$conn->exec($sql);
header('Location:viewStudents.php');

?>