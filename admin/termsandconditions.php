<?php
if (!isset($_SESSION)) {
    session_start();
}
include "../connection/connectionDB.php";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


    .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9); */
        }

        .shadow{
            position:relative;
            /* margin:200px auto 0;
            width:800px; */
            /* height:250px; */
            background:linear-gradient(0deg,#fff,#fefefe);
        }

        .shadow:before,.shadow:after{
            border-radius: 10px;
            content:'';
            position:absolute;
            top:-2px;
            left:-2px;
            background:linear-gradient(45deg,#fb0094,#0000ff,#00ff00,#ffff00,#ff0000,#fb0094,#0000ff,#00ff00,#ffff00,#ff0000);
            background-size: 400%;
            width:calc(100% + 4px);
            height: calc(100% + 4px);
            z-index: -1;
            animation:animate 20s linear infinite;
        }

        .shadow:after{
            filter:blur(20px);
        }

        @keyframes animate{
            0%{
                background-position: 0 0;
            }

            50%{
                background-position: 300% 0;
            }

            100%{
                background-position:0 0;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn-agree, .btn-disagree {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin: 0 10px;
        }

        .btn-agree {
            background-color:white;
            color: #4CAF50;
            width: 100px;
            border:2px solid #4CAF50;
            transition:0.3s;
        }

        .btn-agree:hover{
            background-color: #4CAF50;
            color: white;
            width: 100px;
        }

        .btn-disagree {
            background-color: white;
            color: #f44336;
            width: 100px;
            border:2px solid #f44336;
            transition:0.3s;
        }

        .btn-disagree:hover{
            background-color: #f44336;
            color: white;
            width: 100px;   
        }
body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
    background: white;
}

.contactform{
       padding:5rem;
       width:24.5rem;
       margin:0 auto;
       background:black;
       color:white;
       align-items:center;
       box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       border-radius:25px;
       
    }

    textarea
    {
        resize: none;
    }

   .contentitems
    {
        text-align:center;
    }

    form input[type="text"]
    {
        width:240px;
    }

    form input[type="email"]
    {
        width:240px;
    }

    .btnsend
    {
        background:white;
        color:black;
        border:none;
        border-radius:5px;
        padding:5px 10px 5px 10px;
    }

    .btnsend:hover
    {
        background:grey;
    }
    .text
       {
           text-align:center;
       }

       .title
       {
        text-align:center;
       }

       .terms-and-conditions { max-width: 800px; margin: 0 auto; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.5; color: #333; } 
       .terms-and-conditions h2 { margin-top: 50px; margin-bottom: 20px; font-size: 24px; font-weight: bold; } 
       .terms-and-conditions p { margin-bottom: 30px; } 

       /* iPad Air */
@media (max-width:820px)  
{

   .container
    {
        
       margin-bottom:300px;

    }
}

</style>
</head>
<body>
<?php include("../controller/alertBox.php")?>
<div class="container shadow">
<div class="terms-and-conditions"> 
<center><h2>Terms and Conditions</h2></center>
    <center><h1>*****</h1></center>
    <br>
    <p><strong>1. Eligibility:</strong> Only current staff members of the university are eligible to submit ideas through the online platform. By submitting an idea, staff confirm they are authorized representatives of the university and agree to adhere to these terms and conditions.</p> 
    <p><strong>2. Idea Submission:</strong> All ideas submitted must be original work of the staff member and should not infringe upon any third-party rights, including copyrights, trademarks, or patents. Plagiarism or unauthorized use of intellectual property is strictly prohibited.</p> 
    <p><strong>3. Confidentiality:</strong> Staff must ensure that their ideas do not contain confidential or sensitive information belonging to the university or any other entity. They should refrain from disclosing any proprietary or confidential information in their submissions.</p> 
    <p><strong>4. Ownership:</strong> By submitting an idea, staff acknowledge and agree that the university shall own all rights, title, and interest in and to the submitted idea. Staff relinquish any claim to ownership or intellectual property rights associated with the idea upon submission.</p> 
    <p><strong>5. Acceptance:</strong> Submission of an idea does not guarantee its acceptance or implementation by the university. The university reserves the right to review, evaluate, and reject any idea at its discretion, without providing reasons for rejection.</p> 
    <p><strong>6. Online Submission:</strong> When submitting ideas through the online platform, staff must ensure that they comply with all technical requirements and guidelines provided. The university is not responsible for any technical issues or errors encountered during the submission process.</p> 
    <p><strong>7. Compliance:</strong> All ideas submitted must comply with applicable laws, regulations, and university policies. Staff are responsible for ensuring that their submissions do not contain any content that is unlawful, defamatory, discriminatory, or otherwise objectionable.</p> 
    <p><strong>8. Feedback:</strong> Staff may receive feedback or suggestions from the university regarding their submitted ideas. Such feedback is provided for the purpose of improvement and does not imply endorsement or acceptance of the idea.</p> 
    <p><strong>9. Review Process:</strong> Submitted ideas will undergo a review process by the university, which may include evaluation by relevant departments, committees, or experts. Staff may be contacted for additional information or clarification during the review process.</p> 
    <p><strong>10. Modifications:</strong> These terms and conditions are subject to change by the university at any time without prior notice. Staff are encouraged to review the terms periodically to stay informed of any updates or revisions.</p> 
    <p>By submitting an idea through the online platform, staff acknowledge that they have read, understood, and agreed to comply with these terms and conditions. Violation of any term may result in the rejection of the idea and may lead to disciplinary action.</p>
       



    <div class="btn-container">
        <form action="termsandconditions.php" method="post">
            <button class="btn-agree" name="agree" value="agree">Agree</button>
            <button class="btn-disagree" name="disagree" value="disagree">Disagree</button>
        </form>
    </div>

    <?php

    if(isset($_POST["agree"]))
    {
        $id = $_SESSION['current_id'];
        $data = "UPDATE admin SET agreement = 'yes' WHERE id = :user_id";
        $data = $conn->prepare($data);
        $data->bindParam(':user_id', $id);
        $data->execute();
        $dataSet = $data->fetch(PDO::FETCH_ASSOC);

        $uid = $_SESSION['uid'] ;
        $content = $_SESSION['content'] ;
        $category = $_SESSION['category'];
        $today_date = $_SESSION['today_date'];
        $username = $_SESSION['username'];
        $postAnno = $_SESSION['postAnno'];
        $fileName = $_SESSION['fileName'];

        unset($_SESSION['content']);
        unset($_SESSION['category']);
        unset($_SESSION['today_date']);
        unset($_SESSION['postAnno']);


        // echo $_SESSION["uploaded_file"];
        // echo $_SESSION["fileName"];
        if (isset($_SESSION["uploaded_file"]) && isset($_SESSION["fileName"])) {
            $base64EncodedFile = $_SESSION["uploaded_file"];
            $fileName = $_SESSION["fileName"];
            unset($_SESSION["uploaded_file"]);
            unset($_SESSION['fileName']);
        
            // Get the file extension
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        
            // Check if the file extension is not allowed (e.g., not a document format)
            $allowedExtensions = array("docx"); // Add more allowed extensions if needed
            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                $_SESSION['al_msg'] = array('type' => 'Info', 'header' =>'Warning', 'body'=>"Please upload a document file (.docx).");
                echo "window.location.href = 'feed.php';</script>";
                exit();
            }
        
            // Decode the base64 encoded file content
            $fileContent = base64_decode($base64EncodedFile);
            // Directory where you want to move the file
            $targetDirectory = "../userfiles/";
        
            // Ensure that the target directory exists and is writable
            if (!is_dir($targetDirectory) || !is_writable($targetDirectory)) {
                echo "Error: The target directory is not writable or does not exist.";
                exit();
            }
        
            // Path to the target file
            $targetFile = $targetDirectory . $fileName;
        
            // Move the file to the target directory
            if (file_put_contents($targetFile, $fileContent)) {
                // Assuming $conn is your database connection
                $sql = "INSERT INTO ideas (uid, username, content, file, like_count, unlike_count, comment_count, category, date_created, Post_Anno) VALUES (:uid, :username, :content, :file_name, 0, 0, 0, :category, :today_date, :postAnno)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':file_name', $fileName);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':today_date', $today_date);
                $stmt->bindParam(':postAnno', $postAnno);
        
                if ($stmt->execute()) {
                    // Redirect to the feed page
                    echo "<script>
                    location.href = '../admin/feed.php';
                    </Script>";
                    exit();
                } else {
                    // Error occurred while inserting data into the database
                    echo "Error occurred while inserting data into the database";
                }
            } else {
                // Error occurred while moving the file
                echo "Error occurred while moving the file to the target directory";
            }
        
            // Unset session variables after use
            unset($_SESSION["base64EncodedFile"]);
            unset($_SESSION["file_name"]);
        } else {
            // Session variables not set, handle the error accordingly
         $sql = "INSERT INTO ideas (uid, username, content, like_count, unlike_count, comment_count, category, date_created, Post_Anno) VALUES (:uid, :username, :content, 0, 0, 0, :category, :today_date, :postAnno)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':uid', $uid);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':today_date', $today_date);
                $stmt->bindParam(':postAnno', $postAnno);
                $stmt->execute();

                $_SESSION['al_msg'] = array('type' => 'info', 'header' =>'Information', 'body'=>"Your idea was submitted!");
                echo "<script>
                location.href = '../admin/feed.php';
                </Script>";
        }

    ?>

    
    <?php }elseif(isset($_POST["disagree"])){
        
    ?>
            <script>
            <?php $_SESSION['al_msg'] = array('type' => 'Info', 'header' =>'Warning', 'body'=>"You must agreed to the terms and conditions."); ?>
            window.location.href = "feed.php";
        </script>
    <?php }?>


</div>
<br><br>
</body>
</html>