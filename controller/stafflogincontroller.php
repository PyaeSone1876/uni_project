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
        $sql = "select * from staff where email='$email' and password = '$password'";
        $stmt = $conn->query($sql);
        $row = $stmt->rowCount();
        $fetch = $stmt->fetch();
 
        if($row>0)
        {
            $_SESSION["id"]= $fetch["id"];
            $_SESSION["email"]= $fetch["email"];
            $_SESSION["username"]= $fetch["username"];
            $_SESSION["current_id"] = $_SESSION['id'];

            $_SESSION['al_msg'] = array('type' => 'success', 'header' =>'Congratulation!', 'body'=>"Login Successful!!!'");

                echo "
                <script>
                   location.href='../staff/feed.php';
                    </script>";
        }
        else
        {

            $_SESSION['al_msg'] = array('type' => 'cancle', 'header' =>'Invalid', 'body'=>"Ohh! Incorrect username or password");

            echo "<script>
                    location.href = '../staff/loginForm.php';
                </script>";
        }
    }
?>