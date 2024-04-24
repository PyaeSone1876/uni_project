<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $post_id = $_SESSION['c_id'];
    $sql1 = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY id DESC";
    $stmt = $conn->prepare($sql1);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    

    if (!isset($_SESSION['like_count'])) {
        $_SESSION['like_count'] = 0;
    }

    if (!isset($_SESSION['unlike_count'])) {
        $_SESSION['unlike_count'] = 0;
    }

    $like_count = $_SESSION['like_count']; // Retrieve like count from session
    $unlike_count = $_SESSION['unlike_count'];

    function timeAgo($datetime) {
        date_default_timezone_set('Asia/Yangon'); // Set the time zone to Myanmar time zone
        $timestamp = strtotime($datetime);
        $current_time = time();
        $time_difference = $current_time - $timestamp;
        $seconds = $time_difference;
        $minutes = round($seconds / 60); // Calculate minutes
        $hours = round($seconds / 3600); // Calculate hours
        $days = round($seconds / 86400); // Calculate days
        $weeks = round($seconds / 604800); // Calculate weeks
        $months = round($seconds / 2629440); // Calculate months
        $years = round($seconds / 31553280); // Calculate years
    
        // Check seconds
        if ($seconds <= 60) {
            return "Just now";
        } elseif ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 min ago";
            } else {
                return "$minutes mins ago";
            }
        } elseif ($hours <= 24) {
            if ($hours == 1) {
                return "1 hour ago";
            } else {
                return "$hours hours ago";
            }
        } elseif ($days <= 7) {
            if ($days == 1) {
                return "1 day ago";
            } else {
                return "$days days ago";
            }
        } elseif ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "1 week ago";
            } else {
                return "$weeks weeks ago";
            }
        } elseif ($months <= 12) {
            if ($months == 1) {
                return "1 month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "1 year ago";
            } else {
                return "$years years ago";
            }
        }
    }
    
    $stmt = $conn->prepare("SELECT COUNT(*) AS row_count FROM date_time");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row_count = $row['row_count'];
    
    if ($row_count > 0) {

   
        $sqlFinalClosureDate = "SELECT final_closuredate FROM date_time";
        $stmtFinalClosureDate = $conn->query($sqlFinalClosureDate);
        $rowFinalClosureDate = $stmtFinalClosureDate->fetch(PDO::FETCH_ASSOC);
        $finalClosureDate = $rowFinalClosureDate['final_closuredate'];
        date_default_timezone_set('Asia/Yangon');
        $currentDate = date("F j, Y, g:i a");
   
       }
       $_SESSION["location"]="comment";
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

        .contactform {
            padding: 5rem;
            width: 24.5rem;
            margin: 0 auto;
            background: black;
            color: white;
            align-items: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            border-radius: 25px;
        }

        textarea {
            resize: none;
            width: 193%
        }

        .contentitems {
            text-align: center;
        }

        form input[type="text"] {
            width: 240px;
        }

        form input[type="email"] {
            width: 240px;
        }

        .btnsend {
            background: white;
            color: black;
            border: none;
            border-radius: 5px;
            padding: 5px 10px 5px 10px;
        }

        .btnsend:hover {
            background: grey;
        }

        .text {
            text-align: center;
        }

        .text1{
            left: 5.6%;
        }

        .text2{
            left: 21.7%;
        }

        .text3{
            left: 37.5%;
        }

        .textAll{
            color: #727272;
            width: 132px;
            display: inline-block;
            position: absolute;
            height: 30px;
            text-align: center;
            border-radius: 50%;
            box-sizing: border-box;
            padding: auto;
            padding: 5px;
            bottom: 26px;
            z-index: 1;
            bottom: 390px;
}

        
        .texts{
            border-top: 1px solid #AAA;
            padding-top: 22px;
            width: 96%;
        }

        .title {
            text-align: center;
        }

        .reaction {
            display: flex;
        }

        .buttons {
            width: 60%;
            display: flex;
        }

        .post-container {
            width: 93%;
            margin: auto;
            padding-left: 20px;
            border-radius: 5px;
            align-items: center;
            background: white;
            overflow-y:auto;
            /* max-height:100%; */
            position: relative;
            background: #E8EAF2;
            overflow: visible;
            margin-bottom: 16px;
            max-height: 187px;
}


          .date
        {
            position: absolute;
            right: 20px;
            top: 3px;

        }

        .idea-container{
            width: 96%;
            margin: auto;
            margin-top: auto;
            margin-left: auto;
            margin-top: auto;
            margin-left: auto;
            padding-left: 25px;
            border-radius: 10px;
            align-items: center;
            background: white;
            height: 215px;
            overflow-y: auto;
            max-height: 100%;
            margin-left: 13px;
            margin-top: 15px;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
            box-sizing: border-box;
        }

        .actionbtn:hover{
            /* background-color: #727272; */
            bottom: 345px;
            border: 2px solid #727272;
            border: 1px solid #11468F;
        }
        

        .write-status {
            width: 96.1%;
            margin: auto;
            margin-top: auto;
            margin-top: auto;
            margin-top: auto;
            border-radius: 10px;
            display: flex;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
            margin-top: 70px; 
            padding-left: 10px;
            box-sizing: border-box;
            margin-left: 1.6%;
        }

        .statusplace {
            width: 100%;
            margin-left: 10px;
            margin-top: 20px;
        }

        .status {
            height: 80px;
        }

        .org_post_field
        {
            /* background: green; */
  height: 95%;
  width: 50%;
        }

        .submitbtn {
            width: 129px;
            height: 40px;
            border-radius: 50px;
            background: #11468F;
            color: white;
            border: none;
            margin-left: 48%;
            margin-right: 30px;
            cursor: pointer;
            margin-left: 17%;
            transition: 0.4s;
        }

        .submitbtn:hover{
            background-color: #1860C2;
        }

        .postarea {
            background: #ECD2CC;
            width: 48%;
            border-radius: 10px;
            position: absolute;
            right: 0;
            height: 600px;
            top: 0px;
            overflow: scroll;
            background-color: white;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
            margin-right: 0.6%;
            height: 592px;
        }

        .likebtn{
            left: 7%;
        }

        .unlikebtn{
            left: 23%;
        }

        .commentbtn{
            left: 39%;
        }

        .infotext {
            font-size: 20px;
            margin-top: 264px;
        }
        
        .textplace
        {
        max-width: 280px; 
        white-space: normal;
        word-wrap: break-word;
        }

        .status textarea{
            resize: none;
            width: 529px;
            border-radius: 4px;
            border: 1px solid rgb(183, 185, 190);
            padding: 10px;
            box-sizing: border-box;
            width: 98%;
        }

        .status textarea:focus{
            outline: none;
        }
        
        .contentPlace{
            padding-left: 14px;
            margin-bottom: 48px;
            margin-top: 10px;
        }

        .cmtContentPlace{
            padding-left: 14px;
            margin-bottom: 38px;
            margin-top: 10px;
        }

        .actionbtn {
        position: absolute;
        bottom: 354px;
        height: 35px;
        width: 77px;
        border-radius: 11px;
        border: none;
        background: gray;
        cursor: pointer;
        border: 1px solid #11468F;
        background: white;
        color: #727272;
        color: #11468F;
        transition: border 0.1s ease, bottom 0.3s ease;
        }

        .upperPart{

        }

        .cmtlikebtn{
            left: 30%;
        }

        .cmtUnlikebtn{
            left: 60%;
        }

        
        .cmtlikebtn.liked,
        .cmtUnlikebtn.unliked {
            background: #727272;
            background: #11468F;
            color: white;
        }

        .cmtActionBtn{
            position: absolute;
            bottom: -16px;
            height: 35px;
            width: 77px;
            border-radius: 11px;
            border: none;
            background: gray;
            cursor: pointer;
            border: 1px solid #11468F;
            background: white;
            /* color: #727272; */
            color:#11468F;
            transition: border 0.1s ease, bottom 0.3s ease;
        }

        .cmtActionBtn:hover{
            /* background-color: #727272; */
            bottom: -22px;
            /* border: 2px solid #727272; */
            border: 1px solid #11468F;
        }

        .username_postContainer{
            color: #11468F;
            font-weight: bold;
            font-size: 21px;
            margin-left: 5px;
            
        }


        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination-btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid black;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .pagination-btn:hover {
            background-color: black;
            color: white;
        }

        .pagination-btn.active {
            background-color: black;
            color: white;
            border-color: #007bff;
        }

        /* Like button styling when already liked */
        .likebtn.liked,
        .unlikebtn.unliked {
            background: #727272;
            background: #11468F;
            color: white;
        }


        /* iPad Air */
        @media (max-width: 820px) {
            .container {
                margin-bottom: 300px;
            }
        }

        .display_area{
            /* background: gray; */
            position: relative;
            height: 600px;
            width: 100%;
            padding: 0px;
            margin: 0px;
            overflow: scroll;
            margin-bottom: 18px;
        }

        .post{
            
        }

        .cmtText1{
            left: 27%;
        }

        .cmtText2{
            left: 57%;
        }

        .cmtTextAll{
            color: #727272;
            width: 132px;
            display: inline-block;
            position: absolute;
            height: 30px;
            text-align: center;
            border-radius: 50%;
            box-sizing: border-box;
            padding: auto;
            padding: 5px;
            bottom: 21px;
            z-index: 1;
        }


        .submitbtn.disabled {
            background-color: gray;
            cursor: not-allowed;
        }

        /* Adjust hover effect for disabled button */
        .submitbtn.disabled:hover {
            background-color: gray;
        }

        @media screen and (max-width: 1000px) {
            .likebtn {
                left: 6%;
            }

            .unlikebtn {
                left: 21%;
            }

            .commentbtn {
                left: 36%;
            }

            .text1 {
                left: 3.6%;
            }

            .text2 {
                left: 18.7%;
            }

            .text3 {
                left: 33.5%;
            }

            .cmtlikebtn {
                left: 24%;
            }

            .cmtText1 {
                left: 19%;
            }

            .cmtText2 {
                left: 56%;
            }


        }

        
        @media screen and (max-width: 928px) {
            .submitbtn{
                margin-left: 31%;
                display: block;
                margin-top: 18px;
            }

            .statusplace{
                height: 235px;
            }
        }

        
        @media screen and (max-width: 746px) {

            .submitbtn{
                margin-left: 33%;
                display: inline-block;
                margin-top: 18px;
            }

            .postarea{
                margin-top: 276px;
                width: 95%;
                margin-right: 2.6%;
            }

            .idea-container{
                height: 201px;
            }

            .idea-container{
                height: 201px;
                width: 189%;
            }

            .actionbtn:hover{
                bottom: 365px;
            }

            .text1 {
                left: 13.6%;
            }

            .text2 {
                left: 39.7%;
            }

            .text3 {
                left: 68.5%;
            }

            .textAll{
                bottom: 404px;
            }

            .likebtn {
                left: 17%;
            }

            .unlikebtn {
                left: 43%;
            }

            .commentbtn {
                left: 72%;
            }

            .actionbtn{
                bottom: 371px;
            }

            .contentPlace{
                margin-bottom: 39px;
            }

            .display_area{
                overflow: unset;
            }

            .post_area{
                overflow: unset;
            }

            .footer{
                margin-top: 663px;
            }

            .postarea{
                margin-top: 496px;
                height: 688px;
            }

            .write-status{
                width: 96.1%;
                z-index: 2;
            }

            .org_post_field{
                height: 50%;
                width: 100%;
            }

            .idea-container{
                width: 95%;
            }

            .actionbtn{
                bottom: 379px;
            }

            .textAll{
                bottom: 415px;
            }

            .write-status{
                margin-top: 44px;
            }

            .actionbtn:hover {
                bottom: 372px;
            }

            .post-container{
                width: 87%;
            }

        }

        @media screen and (max-width: 742px) {
            .post-container{
                width: 75%;
            }

            .submitbtn{
                margin-top: 10px;
                margin-left:31%;
            }

            .postarea{
                margin-top: 540px;
            }
        }
            
    </style>
</head>
<body>
<?php include("../controller/alertBox.php")?>
    <?php $_SESSION["loc"]=="comment";include 'navbar.php' ?>    
    <!-- <?php echo $_SESSION['c_id']?> -->
    <br>
    <div class="display_area">

<div class="org_post_field">
        
        <?php
        $idea_id = $_SESSION['c_id'];
        $id = $_SESSION['id'];
          $sql = "SELECT * FROM ideas WHERE id = :idea_id";

          // Prepare the SQL statement
          $stmt = $conn->prepare($sql);
      
          // Bind the idea ID parameter
          $stmt->bindParam(':idea_id', $idea_id, PDO::PARAM_INT);
      
          // Execute the query
          $stmt->execute();
      
          // Fetch the result
          $idea = $stmt->fetch(PDO::FETCH_ASSOC); 
        ?>
    <div class="post"> 
    <?php
        $serial = 1;
                // Check if the post is anonymous
                if ($idea['Post_Anno'] === 'Yes') {
                    $username = "Anonymous";
                } else {
                    $username = $idea['username'];
                }
 
                // Check if the user has liked the post
                $post_id = $idea['id'];
                $sqlCheckLike = "SELECT COUNT(*) AS like_count_alias FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
                $stmtCheckLike = $conn->prepare($sqlCheckLike);
                $stmtCheckLike->bindParam(':user_id', $id);
                $stmtCheckLike->bindParam(':post_id', $idea_id);
                $stmtCheckLike->execute();
                $rowLike = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);
                $userLiked = ($rowLike && $rowLike['like_count_alias'] > 0);

                // Check if the user has unliked the post
                $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count_alias FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
                $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
                $stmtCheckUnlike->bindParam(':user_id', $id);
                $stmtCheckUnlike->bindParam(':post_id', $idea_id);
                $stmtCheckUnlike->execute();
                $rowUnlike = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);
                $userUnliked = ($rowUnlike && $rowUnlike['unlike_count_alias'] > 0);
        ?>
                    <div class="idea-container">
                        <br>
                        <div class="textplace upperpart"><i class="fa-solid fa-user icon" style="font-size:18px;"></i><label for="" class="username_postContainer">&nbsp;<?php echo $idea["username"] ?></label></div><br><br>
                        <div class="textplace contentPlace"><?php echo $idea['content'] ?></div>
                        <div class="texts">
                            <label class="text1 textAll"><i class="fa-solid fa-thumbs-up"></i> : <td ><?php echo $idea['like_count'] ?></td></label>
                            <label class="text2 textAll"><i class="fa-solid fa-thumbs-down"></i> : <td ><?php echo $idea['unlike_count']; ?></td></label>
                            <label class="text3 textAll"><td ><i class="fa-solid fa-comment"></i> : <?php echo $idea['comment_count']; ?></td>
                            <?php $_SESSION['author_id']=$idea['uid']?>
                            </label>
                        </div>
                            <br>
                            <div class="buttons">
                                <form action="../controller/qafeedcontroller.php" method="post">
                                    <button value="like" name="like_cmt" class="likebtn actionbtn <?php echo ($userLiked ? 'liked' : ''); ?>">Like</button>
                                    <button value="unlike" name="unlike_cmt" class="unlikebtn actionbtn <?php echo ($userUnliked ? 'unliked' : ''); ?>">Unlike</button>
                                        <button value="comment" name="comment"
                                        id="commentButton" class="commentbtn actionbtn"style="background:#11468F;color:white;">Comment</button>
                                </form>
                            </div>
                            </div>
                            <?php

        ?>
  
    </div>
    <?php
if ($row_count > 0) 
{        $date1 = DateTime::createFromFormat('F j, Y, g:i a', $currentDate);
        $date2 = DateTime::createFromFormat('F j, Y, g:i a', $finalClosureDate);
    
if ($date1 < $date2) {
?>
    <div class="write-status">
        <form class="statusplace" action="../controller/qafeedcontroller.php" method="post" enctype="multipart/form-data">
            <label for="postContent"><strong>Write your comment:</strong></label><br>
            <br>
            <div class="status">
                <textarea placeholder="Write a Comment...." name="PostComment" id="commentTextarea" rows="4" cols="60"></textarea>
            </div><br>
          
            <label for="anonymous"><strong>Comment Anonymously</strong></label>
            <input type="checkbox" id="anonymous" name="anonymous">  
            <input type="submit" value="Comment Now" name="submit_comment" id="submitBtn" class="submitbtn"></input>
            <br><br>
            
        </form>
    </div>
    <?php
}}
    ?>
    <br><br>
    <div class="postarea">
        <br>
        <?php
        $serial = 1;
        if ($results && count($results) > 0) {
            foreach ($results as $key => $row) {
                // Check if the comment is anonymous
                if ($row['post_Anno'] === 'Yes') {
                    $username = "Anonymous";
                } else {
                    $username = $row['username'];
                }
 
                // Check if the user has liked the comment
                $ment_id = $row['id'];
                $sqlCheckLike = "SELECT COUNT(*) AS like_count_alias FROM user_ment_likes WHERE user_id = :user_id AND ment_id = :ment_id";
                $stmtCheckLike = $conn->prepare($sqlCheckLike);
                $stmtCheckLike->bindParam(':user_id', $id);
                $stmtCheckLike->bindParam(':ment_id', $ment_id);
                $stmtCheckLike->execute();
                $rowLike = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);
                $userLiked = ($rowLike && $rowLike['like_count_alias'] > 0);

                // Check if the user has unliked the comment
                $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count_alias FROM user_ment_unlikes WHERE user_id = :user_id AND ment_id = :ment_id";
                $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
                $stmtCheckUnlike->bindParam(':user_id', $id);
                $stmtCheckUnlike->bindParam(':ment_id', $ment_id);
                $stmtCheckUnlike->execute();
                $rowUnlike = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);
                $userUnliked = ($rowUnlike && $rowUnlike['unlike_count_alias'] > 0);
        ?>

                <div class="post">
                    <div class="post-container">
                        <br>
                        <div class="textplace"><i class="fa-solid fa-user icon" style="font-size:18px;"></i><label for="" class="username_postContainer">&nbsp;<?php echo $username?></label></div>
                        <p class="date"><p class="date"><?php echo timeAgo($row['date_ment']) ?></p>
                        <br>
   
                            <div class="textplace cmtContentPlace"><?php echo $row['comments'] ?></div>
                            <div class="texts">
                            <label class="cmtText1 cmtTextAll"><i class="fa-solid fa-thumbs-up"></i> : <td ><?php echo $row['like_count'] ?></td></label>
                            <label class="cmtText2 cmtTextAll"><i class="fa-solid fa-thumbs-down"></i> : <td ><?php echo $row['unlike_count']; ?></td></label>
                                
                            </div>
                            <br>
                            <div class="buttons">
                                <form action="../controller/qafeedcontroller.php" method="post">
                                    <button value="like" name="like_ment" class="cmtlikebtn cmtActionBtn <?php echo ($userLiked ? 'liked' : ''); ?>">Like</button>
                                    <button value="unlike" name="unlike_ment" class="cmtUnlikebtn cmtActionBtn <?php echo ($userUnliked ? 'unliked' : ''); ?>">Unlike</button>
                                    <input type="hidden" name="ment_id" value="<?php echo $row['id'] ?>">
                                </form>
                            </div>
                        <br>
                    </div>
                </div>
                <br>
        <?php
            }
        } else {
            echo "<center><p class='infotext'>\"No comments available\"</p></center><br><br>";
        }
        ?>
     
    </div>
</div>
    </div>
<?php include 'footer.php' ?>
</body>
</html>
<script>
    document.getElementById("commentButton").disabled = true;

    const textarea = document.getElementById('commentTextarea');
        const submitBtn = document.getElementById('submitBtn');
        if (textarea.value.trim() === '') {
                // If empty, disable the submit button and add disabled class
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            }
        // Add event listener to textarea for input changes
        textarea.addEventListener('input', function() {
            // Check if the textarea is empty
            if (textarea.value.trim() === '') {
                // If empty, disable the submit button and add disabled class
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
            } else {
                // If not empty, enable the submit button and remove disabled class
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
            }
        });
</script>
<?php
}
?>
