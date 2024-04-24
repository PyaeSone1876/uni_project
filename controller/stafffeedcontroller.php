<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../connection/connectionDB.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


if (isset($_POST['submit'])) {   

    $uid = $_SESSION['id'];
    $content = $_POST['postContent'];
    $category = $_POST['category_list'];
    date_default_timezone_set('Asia/Yangon');
    $today_date = date('F j, Y, g:i a');
    $year = date('Y', strtotime($today_date));
    $username = $_SESSION['username'];
    $file_name = ''; 
    $postAnno = isset($_POST['anonymous']) ? 'Yes' : 'No'; 
    
    $c_user_id =  $_SESSION['current_id'];
    
    $data = "SELECT * FROM staff WHERE id = :user_id";
    $data = $conn->prepare($data);
    $data->bindParam(':user_id', $c_user_id);
    $data->execute();
    $dataSet = $data->fetch(PDO::FETCH_ASSOC);

    $agreeStatus = $dataSet['agreement'];

    if($agreeStatus == "no")
    {
        $_SESSION['uid'] = $uid;
        $_SESSION['content'] = $content;
        $_SESSION['category'] = $category;
        $_SESSION['today_date'] = $today_date;
        $_SESSION['username'] = $username;
        $_SESSION['file_name'] = $file_name;
        $_SESSION['postAnno'] = $postAnno;
        $_SESSION['fileName'] = "";

        if(isset($_FILES["userfile"])) {
            // Check if there are no errors with the file upload
            if ($_FILES["userfile"]["error"] === UPLOAD_ERR_OK) {
                // Read the temporary file location
                $fileContent = file_get_contents($_FILES["userfile"]["tmp_name"]);
        
                // Encode the file content in base64
                $base64EncodedFile = base64_encode($fileContent);
        
                // Store the base64 encoded content in the session
                $_SESSION["uploaded_file"] = $base64EncodedFile;
        
                // Store the file name in the session
                $_SESSION['fileName'] = $_FILES["userfile"]["name"];

                // echo $_SESSION["fileName"];
            } else {
                // Handle file upload errors
                echo "File upload failed with error code: " . $_FILES["userfile"]["error"];
            }
        }


        echo "<script>
        location.href = '../staff/termsandconditions.php';
        </Script>";
    }
    else{

        if (!empty($_FILES["userfile"]["name"])) { 
            $_SESSION["message"] = "reach";
            $file_name = $_FILES["userfile"]["name"];
            $file_size = $_FILES["userfile"]["size"];
            $file_temp = $_FILES["userfile"]["tmp_name"];
            $file_type = $_FILES["userfile"]["type"];
            $target_dir = "../userfiles/";
            $target_file = $target_dir.basename($file_name);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $ext = array("docx");

            if (!in_array($file_ext, $ext)) 
            {
                $_SESSION['al_msg'] = array('type' => 'Warning', 'header' =>'Warning', 'body'=>"Please upload a document file (.docx).");

                $error[] = "Not allow extension";
                echo "<script>
                location.href = '../staff/feed.php';
                </script>";
             } else if ($file_size > 1097152) 
            {

            $_SESSION['al_msg'] = array('type' => 'cancle', 'header' =>'Invalid', 'body'=>"Your file is too big!");

                $error[] = "file size is too long";
            }   
            echo "<script>
            location.href = '../staff/feed.php';
            </script>";
            }

        if (empty($error)) {
            if (!empty($file_name) && move_uploaded_file($file_temp, $target_file)) {
            $sql = "INSERT INTO ideas (uid, username, content, file, like_count, unlike_count, comment_count, category, date_created,year, Post_Anno) VALUES (:uid, :username, :content, :file_name, 0, 0, 0, :category, :today_date, :year, :postAnno)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':file_name', $file_name);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':today_date', $today_date);
            $stmt->bindParam(':year', $year);
            $stmt->bindParam(':postAnno', $postAnno);
            $stmt->execute();

            $_SESSION['al_msg'] = array('type' => 'info', 'header' =>'Information', 'body'=>"Your idea was submitted!");

            $uid = $_SESSION['id'];

                $sql = "SELECT department FROM qamanager WHERE id = :uid
                        UNION
                        SELECT department FROM staff WHERE id = :uid
                        UNION
                        SELECT department FROM admin WHERE id = :uid
                        UNION
                        SELECT department FROM qacoordinator WHERE id = :uid";
   try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();
    
    // Fetch the department
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $department = $row['department'];
    
    // Check if department is "IT Department"
    if ($department == "IT Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'IT Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for IT Department.";
        }
    }
    
    if ($department == "Student Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Student Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Student Department.";
        }
    }

    if ($department == "Finance Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Finance Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Finance Department.";
        }
    }

    if ($department == "Customer Service Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Customer Service Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Customer Service Department.";
        }
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                         // Enable SMTP authentication
    $mail->Username   = 'universitysystem123@gmail.com';  // SMTP username
    $mail->Password   = 'eavs gllc mhle cave';        // SMTP password
    $mail->SMTPSecure = 'ssl';                        // Enable TLS encryption
    $mail->Port       = 465;                          // TCP port to connect to

    // Set your desired email address, subject, and message
    $recipientEmail = $_SESSION['post_email'] ;
    $subject = 'New idea posted by '.$username."! Check it out!";
    $message = "The new ideas was '".$content."'.";

    // Set recipients, isHTML, Subject, and Body
    $mail->setFrom('universitysystem123@gmail.com');
    $mail->addAddress($recipientEmail);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    echo "success!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

            echo "<script>
            location.href = '../staff/feed.php';
            </Script>";
            } else {
                $sql = "INSERT INTO ideas (uid, username, content, like_count, unlike_count, comment_count, category, date_created, year, Post_Anno) VALUES (:uid, :username, :content, 0, 0, 0, :category, :today_date, :year, :postAnno)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':today_date', $today_date);
                $stmt->bindParam(':year', $year);
                $stmt->bindParam(':postAnno', $postAnno);
                $stmt->execute();

                $_SESSION['al_msg'] = array('type' => 'info', 'header' =>'Information', 'body'=>"Your idea was submitted!");

                $uid = $_SESSION['id'];

                $sql = "SELECT department FROM qamanager WHERE id = :uid
                        UNION
                        SELECT department FROM staff WHERE id = :uid
                        UNION
                        SELECT department FROM admin WHERE id = :uid
                        UNION
                        SELECT department FROM qacoordinator WHERE id = :uid";
   try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':uid', $uid);
    $stmt->execute();
    
    // Fetch the department
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $department = $row['department'];
    
    // Check if department is "IT Department"
    if ($department == "IT Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'IT Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for IT Department.";
        }
    }
    
    if ($department == "Student Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Student Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Student Department.";
        }
    }

    if ($department == "Finance Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Finance Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Finance Department.";
        }
    }

    if ($department == "Customer Service Department") {
        // Get the email from the qacoordinator table
        $qacoordinator_sql = "SELECT email FROM qacoordinator WHERE department = 'Customer Service Department'";
        $qacoordinator_stmt = $conn->prepare($qacoordinator_sql);
        $qacoordinator_stmt->execute();
        
        // Check if email was found
        if ($qacoordinator_stmt->rowCount() > 0) {
            // Fetch the email
            $qacoordinator_row = $qacoordinator_stmt->fetch(PDO::FETCH_ASSOC);
            $email = $qacoordinator_row['email'];
            $_SESSION['post_email'] = $email;
 
        } else {
            echo "Email not found for Customer Service Department.";
        }
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                         // Enable SMTP authentication
    $mail->Username   = 'universitysystem123@gmail.com';  // SMTP username
    $mail->Password   = 'eavs gllc mhle cave';        // SMTP password
    $mail->SMTPSecure = 'ssl';                        // Enable TLS encryption
    $mail->Port       = 465;                          // TCP port to connect to

    // Set your desired email address, subject, and message
    $recipientEmail = $_SESSION['post_email'] ;
    $subject = 'New idea posted by '.$username."! Check it out!";
    $message = "The new ideas was '".$content."'.";

    // Set recipients, isHTML, Subject, and Body
    $mail->setFrom('universitysystem123@gmail.com');
    $mail->addAddress($recipientEmail);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    echo "success!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

    echo "<script>
    location.href = '../staff/feed.php';
    </Script>";
            }
        }
    }
}

if (isset($_POST['like'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];

    $sqlUpdateViewsCount = "UPDATE ideas SET views = views + 1 WHERE id = :post_id";
    $stmtUpdateViewsCount = $conn->prepare($sqlUpdateViewsCount);
    $stmtUpdateViewsCount->bindParam(':post_id', $post_id);
    $stmtUpdateViewsCount->execute();
    

    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckLike = $conn->prepare($sqlCheckLike);
    $stmtCheckLike->bindParam(':user_id', $user_id);
    $stmtCheckLike->bindParam(':post_id', $post_id);
    $stmtCheckLike->execute();
    $row = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);


    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];


    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $stmtCheckUnlike->bindParam(':user_id', $user_id);
    $stmtCheckUnlike->bindParam(':post_id', $post_id);
    $stmtCheckUnlike->execute();
    $row1 = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['like_count'] == 0 ) {
 
        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count + 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();

        $sqlInsertLike = "INSERT INTO user_post_likes (user_id, post_id) VALUES (:user_id, :post_id)";
        $stmtInsertLike = $conn->prepare($sqlInsertLike);
        $stmtInsertLike->bindParam(':user_id', $user_id);
        $stmtInsertLike->bindParam(':post_id', $post_id);
        $stmtInsertLike->execute();

        if ($row1 && $row1['unlike_count'] != 0) {
        $sqlDeleteLike = "DELETE FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count - 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();
        }
        echo "<script>location.href = '../staff/feed.php';</script>";
    } else {

        
        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count - 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();

        $sqlDeleteLike = "DELETE FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();
        echo "<script>location.href = '../staff/feed.php';</script>";
    }
} 

//like button of idea in comment section
if (isset($_POST['like_cmt'])) {

    $post_id = $_SESSION['c_id'];
    $user_id = $_SESSION['id'];

     
    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckLike = $conn->prepare($sqlCheckLike);
    $stmtCheckLike->bindParam(':user_id', $user_id);
    $stmtCheckLike->bindParam(':post_id', $post_id);
    $stmtCheckLike->execute();
    $row = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);


    $post_id = $_SESSION['c_id'];
    $user_id = $_SESSION['id'];


    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $stmtCheckUnlike->bindParam(':user_id', $user_id);
    $stmtCheckUnlike->bindParam(':post_id', $post_id);
    $stmtCheckUnlike->execute();
    $row1 = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['like_count'] == 0 ) {
 
        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count + 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();

        $sqlInsertLike = "INSERT INTO user_post_likes (user_id, post_id) VALUES (:user_id, :post_id)";
        $stmtInsertLike = $conn->prepare($sqlInsertLike);
        $stmtInsertLike->bindParam(':user_id', $user_id);
        $stmtInsertLike->bindParam(':post_id', $post_id);
        $stmtInsertLike->execute();

        if ($row1 && $row1['unlike_count'] != 0) {
        $sqlDeleteLike = "DELETE FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count - 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();
        }
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    } else {

        
        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count - 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();

        $sqlDeleteLike = "DELETE FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    }
} 

if (isset($_POST['unlike'])) {

    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];

    $sqlUpdateViewsCount = "UPDATE ideas SET views = views + 1 WHERE id = :post_id";
    $stmtUpdateViewsCount = $conn->prepare($sqlUpdateViewsCount);
    $stmtUpdateViewsCount->bindParam(':post_id', $post_id);
    $stmtUpdateViewsCount->execute();
    
    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $stmtCheckUnlike->bindParam(':user_id', $user_id);
    $stmtCheckUnlike->bindParam(':post_id', $post_id);
    $stmtCheckUnlike->execute();
    $row = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);
 
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];

    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckLike = $conn->prepare($sqlCheckLike);
    $stmtCheckLike->bindParam(':user_id', $user_id);
    $stmtCheckLike->bindParam(':post_id', $post_id);
    $stmtCheckLike->execute();
    $row1 = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['unlike_count'] == 0) {

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count + 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();

        $sqlInsertUnlike = "INSERT INTO user_post_unlikes (user_id, post_id) VALUES (:user_id, :post_id)";
        $stmtInsertUnlike = $conn->prepare($sqlInsertUnlike);
        $stmtInsertUnlike->bindParam(':user_id', $user_id);
        $stmtInsertUnlike->bindParam(':post_id', $post_id);
        $stmtInsertUnlike->execute();

        if ($row1 && $row1['like_count'] != 0)
        {

        $sqlDeleteLike = "DELETE FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count - 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();
        }
        echo "<script>location.href = '../staff/feed.php';</script>";
      
    } else {

 

        $sqlDeleteLike = "DELETE FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count - 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();
        echo "<script>location.href = '../staff/feed.php';</script>";
    }
}

//Unlike button of idea in comment section
if (isset($_POST['unlike_cmt'])) {
    $post_id = $_SESSION['c_id'];
    $user_id = $_SESSION['id'];

    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $stmtCheckUnlike->bindParam(':user_id', $user_id);
    $stmtCheckUnlike->bindParam(':post_id', $post_id);
    $stmtCheckUnlike->execute();
    $row = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);
 
    $post_id = $_SESSION['c_id'];
    $user_id = $_SESSION['id'];

    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
    $stmtCheckLike = $conn->prepare($sqlCheckLike);
    $stmtCheckLike->bindParam(':user_id', $user_id);
    $stmtCheckLike->bindParam(':post_id', $post_id);
    $stmtCheckLike->execute();
    $row1 = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['unlike_count'] == 0) {

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count + 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();

        $sqlInsertUnlike = "INSERT INTO user_post_unlikes (user_id, post_id) VALUES (:user_id, :post_id)";
        $stmtInsertUnlike = $conn->prepare($sqlInsertUnlike);
        $stmtInsertUnlike->bindParam(':user_id', $user_id);
        $stmtInsertUnlike->bindParam(':post_id', $post_id);
        $stmtInsertUnlike->execute();

        if ($row1 && $row1['like_count'] != 0)
        {

        $sqlDeleteLike = "DELETE FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateLikeCount = "UPDATE ideas SET like_count = like_count - 1 WHERE id = :post_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateLikeCount->execute();
        }
        echo "<script>location.href = '../staff/commentsection.php';</script>";
      
    } else {
        $sqlDeleteLike = "DELETE FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateUnlikeCount = "UPDATE ideas SET unlike_count = unlike_count - 1 WHERE id = :post_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':post_id', $post_id);
        $stmtUpdateUnlikeCount->execute();
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    }
}

if (isset($_POST['comment'])) {
    $post_id = $_POST['post_id'];
    $_SESSION['c_id'] = $_POST['post_id'];
    $_SESSION['loc']="comment";

    $sqlUpdateViewsCount = "UPDATE ideas SET views = views + 1 WHERE id = :post_id";
    $stmtUpdateViewsCount = $conn->prepare($sqlUpdateViewsCount);
    $stmtUpdateViewsCount->bindParam(':post_id', $post_id);
    $stmtUpdateViewsCount->execute();

    header('Location:../staff/commentsection.php');
    exit();
}



if (isset($_POST['submit_comment'])) {

    $uid = $_SESSION['id'];
    $comments = $_POST['PostComment'];
    date_default_timezone_set('Asia/Yangon');
    $today_date = date('F j, Y, g:i a');
    $username = $_SESSION['username'];
    $file_name = ''; 
    $postAnno = isset($_POST['anonymous']) ? 'Yes' : 'No'; 
    $post_id = $_SESSION['c_id'];


            $sql = "INSERT INTO comments (post_id,uid, username,comments, like_count, unlike_count, date_ment, post_Anno) VALUES (:post_id, :uid, :username, :comments, 0, 0,:date_ment, :postAnno)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->bindParam(':comments', $comments);
            $stmt->bindParam(':date_ment', $today_date);
            $stmt->bindParam(':postAnno', $postAnno);
            $stmt->execute();
            
            
            $sqlUpdateCommentCount = "UPDATE ideas SET comment_count = comment_count + 1 WHERE id = :post_id";
            $sqlUpdateCommentCount = $conn->prepare($sqlUpdateCommentCount);
            $sqlUpdateCommentCount->bindParam(':post_id', $post_id);
            $sqlUpdateCommentCount->execute();
          

$id = $_SESSION['author_id'];

// Assuming you have a table named 'staff', 'qamanager', and 'admin' with 'id' and 'email' columns
$tables = ['staff', 'qamanager', 'admin', 'qacoordinator'];
$email = '';

foreach ($tables as $table) {
    $query = $conn->prepare("SELECT email FROM $table WHERE id = :id");
    $query->execute(array(':id' => $id));
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['email'])) {
        $email = $result['email'];
        break;
    }
}

if (!$email) {
    // Handle the case where email is not found
    echo "Email not found for the provided ID";
    exit;
}

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                         // Enable SMTP authentication
    $mail->Username   = 'universitysystem123@gmail.com';  // SMTP username
    $mail->Password   = 'eavs gllc mhle cave';        // SMTP password
    $mail->SMTPSecure = 'ssl';                        // Enable TLS encryption
    $mail->Port       = 465;                          // TCP port to connect to

    // Set your desired email address, subject, and message
    $recipientEmail = $email;
    $subject = 'Your got a new comment! Check out now!';
    $message = "The comment was '$comments'.";

    // Set recipients, isHTML, Subject, and Body
    $mail->setFrom('universitysystem123@gmail.com');
    $mail->addAddress($recipientEmail);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    echo "success!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$_SESSION['al_msg'] = array('type' => 'Info', 'header' =>'Information', 'body'=>"Your comment was submitted!");

            echo "<script>
            location.href = '../staff/commentsection.php';
            </Script>";
 
        
}

//Comment Like button click 
if (isset($_POST['like_ment'])) {
    $user_id = $_SESSION['id'];
    $ment_id = $_POST['ment_id'];

    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_ment_likes WHERE user_id = :user_id AND ment_id = :ment_id";
    $stmtCheckLike = $conn->prepare($sqlCheckLike);
    $stmtCheckLike->bindParam(':user_id', $user_id);
    $stmtCheckLike->bindParam(':ment_id', $ment_id);
    $stmtCheckLike->execute();
    $row = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);

    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_ment_unlikes WHERE user_id = :user_id AND ment_id = :ment_id";
    $sqlCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $sqlCheckUnlike->bindParam(':user_id', $user_id);
    $sqlCheckUnlike->bindParam(':ment_id', $ment_id);
    $sqlCheckUnlike->execute();
    $row1 = $sqlCheckUnlike->fetch(PDO::FETCH_ASSOC);


    if ($row && $row['like_count'] == 0 ) {
 
        $sqlUpdateLikeCount = "UPDATE comments SET like_count = like_count + 1 WHERE id = :ment_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':ment_id', $ment_id);
        $stmtUpdateLikeCount->execute();

        $sqlInsertLike = "INSERT INTO user_ment_likes (user_id, ment_id) VALUES (:user_id, :ment_id)";
        $stmtInsertLike = $conn->prepare($sqlInsertLike);
        $stmtInsertLike->bindParam(':user_id', $user_id);
        $stmtInsertLike->bindParam(':ment_id', $ment_id);
        $stmtInsertLike->execute();

        if ($row1 && $row1['unlike_count'] != 0) {
        $sqlDeleteLike = "DELETE FROM user_ment_unlikes WHERE user_id = :user_id AND ment_id = :ment_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':ment_id', $ment_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();

        $sqlUpdateUnlikeCount = "UPDATE comments SET unlike_count = unlike_count - 1 WHERE id = :ment_id";
        $stmtUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $stmtUpdateUnlikeCount->bindParam(':ment_id', $ment_id);
        $stmtUpdateUnlikeCount->execute();
        }
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    } else {

        $sqlUpdateLikeCount = "UPDATE comments SET like_count = like_count - 1 WHERE id = :ment_id";
        $stmtUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $stmtUpdateLikeCount->bindParam(':ment_id', $ment_id);
        $stmtUpdateLikeCount->execute();

        $sqlDeleteLike = "DELETE FROM user_ment_likes WHERE user_id = :user_id AND ment_id = :ment_id"; 
        $stmtDeleteLike = $conn->prepare($sqlDeleteLike);
        $stmtDeleteLike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteLike->bindParam(':ment_id', $ment_id, PDO::PARAM_INT);
        $stmtDeleteLike->execute();
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    }
} 


//Comment unlike button click 
if (isset($_POST['unlike_ment'])) {
    $user_id = $_SESSION['id'];
    $ment_id = $_POST['ment_id'];

    $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count FROM user_ment_unlikes WHERE user_id = :user_id AND ment_id = :ment_id";
    $sqlCheckUnlike = $conn->prepare($sqlCheckUnlike);
    $sqlCheckUnlike->bindParam(':user_id', $user_id);
    $sqlCheckUnlike->bindParam(':ment_id', $ment_id);
    $sqlCheckUnlike->execute();
    $row = $sqlCheckUnlike->fetch(PDO::FETCH_ASSOC);

    $sqlCheckLike = "SELECT COUNT(*) AS like_count FROM user_ment_likes WHERE user_id = :user_id AND ment_id = :ment_id";
    $sqlCheckLike = $conn->prepare($sqlCheckLike);
    $sqlCheckLike->bindParam(':user_id', $user_id);
    $sqlCheckLike->bindParam(':ment_id', $ment_id);
    $sqlCheckLike->execute();
    $row1 = $sqlCheckLike->fetch(PDO::FETCH_ASSOC);


    if ($row && $row['unlike_count'] == 0 ) {
 
        $sqlUpdateUnlikeCount = "UPDATE comments SET unlike_count = unlike_count + 1 WHERE id = :ment_id";
        $sqlUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $sqlUpdateUnlikeCount->bindParam(':ment_id', $ment_id);
        $sqlUpdateUnlikeCount->execute();

        $sqlInsertUnlike = "INSERT INTO user_ment_unlikes (user_id, ment_id) VALUES (:user_id, :ment_id)";
        $sqlInsertUnlike = $conn->prepare($sqlInsertUnlike);
        $sqlInsertUnlike->bindParam(':user_id', $user_id);
        $sqlInsertUnlike->bindParam(':ment_id', $ment_id);
        $sqlInsertUnlike->execute();

        if ($row1 && $row1['like_count'] != 0) {
        $sqlDeleteUnlike = "DELETE FROM user_ment_likes WHERE user_id = :user_id AND ment_id = :ment_id"; 
        $sqlDeleteUnlike = $conn->prepare($sqlDeleteUnlike);
        $sqlDeleteUnlike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $sqlDeleteUnlike->bindParam(':ment_id', $ment_id, PDO::PARAM_INT);
        $sqlDeleteUnlike->execute();

        $sqlUpdateLikeCount = "UPDATE comments SET like_count = like_count - 1 WHERE id = :ment_id";
        $sqlUpdateLikeCount = $conn->prepare($sqlUpdateLikeCount);
        $sqlUpdateLikeCount->bindParam(':ment_id', $ment_id);
        $sqlUpdateLikeCount->execute();
        }
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    } else {

        $sqlUpdateUnlikeCount = "UPDATE comments SET unlike_count = unlike_count - 1 WHERE id = :ment_id";
        $sqlUpdateUnlikeCount = $conn->prepare($sqlUpdateUnlikeCount);
        $sqlUpdateUnlikeCount->bindParam(':ment_id', $ment_id);
        $sqlUpdateUnlikeCount->execute();

        $sqlDeleteUnlike = "DELETE FROM user_ment_unlikes WHERE user_id = :user_id AND ment_id = :ment_id"; 
        $stmtDeleteUnlike = $conn->prepare($sqlDeleteUnlike);
        $stmtDeleteUnlike->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmtDeleteUnlike->bindParam(':ment_id', $ment_id, PDO::PARAM_INT);
        $stmtDeleteUnlike->execute();
        echo "<script>location.href = '../staff/commentsection.php';</script>";
    }
} 

?>