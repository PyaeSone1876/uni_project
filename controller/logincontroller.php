<?php
    if(!isset($_SESSION))
    {
        session_start();
    
    }
    include '../connection/connectionDB.php';

    if(isset($_POST["login"])) //submit
    {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "select * from admin where email='$email' and password = '$password'";
        $stmt = $conn->query($sql);
        $row = $stmt->rowCount();
        $fetch = $stmt->fetch();
 
        if($row>0)
        {
            $_SESSION["id"]= $fetch["id"];
            $_SESSION["email"]= $fetch["email"];
            $_SESSION["username"]= $fetch["username"];

                echo "<script>
                alert('Congratulation!');
                alert('Login Successful!!!');
                   location.href='../admin/dashboard.php';
                    </script>";
        }
        else
        {
            echo "<script>
                    alert('Invaild User');
                </Script>";

            echo "<script>
                    location.href = '../admin/loginform.php';
                </script>";
        }
    }
?>