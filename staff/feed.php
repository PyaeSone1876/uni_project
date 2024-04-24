<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $id = $_SESSION['id'];
    $limit = 5; // Number of posts per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
    $offset = ($page - 1) * $limit; // Offset for SQL query

    // Check if a category is selected
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';

    // Modify the SQL query based on the selected category
    if ($category != 'all') {
        $sql1 = "SELECT * FROM ideas WHERE category = :category ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql1);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    } 
    if ($category == 'all') {
        $sql1 = "SELECT * FROM ideas ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql1);
    }

    if ($category == 'popular') {
       
        $sql1 = "SELECT *, (like_count + unlike_count) AS total_count FROM ideas ORDER BY total_count DESC LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql1);
        
    }

    if ($category == 'most_viewed') {
        // Retrieve most viewed ideas by ordering them by the views column
        $sql1 = "SELECT * FROM ideas ORDER BY views DESC LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($sql1);
    }
    
    
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($_SESSION['like_count'])) {
        $_SESSION['like_count'] = 0;
    }

    if (!isset($_SESSION['unlike_count'])) {
        $_SESSION['unlike_count'] = 0;
    }

    $like_count = $_SESSION['like_count']; 
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

     $sqlClosureDate = "SELECT closure_date FROM date_time";
     $stmtClosureDate = $conn->query($sqlClosureDate);
     $rowClosureDate = $stmtClosureDate->fetch(PDO::FETCH_ASSOC);
     $closureDate = $rowClosureDate['closure_date'];
     date_default_timezone_set('Asia/Yangon');
     $currentDate = date("F j, Y, g:i a");

     $sqlFinalClosureDate = "SELECT final_closuredate FROM date_time";
     $stmtFinalClosureDate = $conn->query($sqlFinalClosureDate);
     $rowFinalClosureDate = $stmtFinalClosureDate->fetch(PDO::FETCH_ASSOC);
     $finalClosureDate = $rowFinalClosureDate['final_closuredate'];
     date_default_timezone_set('Asia/Yangon');
     $currentDate = date("F j, Y, g:i a");

    }
    $_SESSION['location']="feed";


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
            /* background: #E8EAF2; */
            background:white;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            font-family: "calibri";
            /* overflow: hidden; */
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
            width: 529px;
            border-radius: 4px;
            border: 1px solid rgb(183, 185, 190);
            padding: 10px;
            box-sizing: border-box;
        }

        textarea:focus{
            outline: none;
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

        .category{
            position: absolute;
            position: absolute;
            top: 24px;
            left: 230px;
            color: #727272;
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

        .title {
            text-align: center;
        }

        .reaction {
            display: flex;
        }

        .backFilter{
            background-color: rgba(0,0,0,0.5);
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 1;
            top: 0px;
            left: 0px;
            display: none;
        }

        .buttons {
            width: 60%;
            display: flex;
        }
        
        .post-container {
            width: 50%;
            margin: auto;
            padding-left: 20px;
            border-radius: 10px;
            align-items: center;
            background: #E8EAF2;
            position: relative;
        }

        .date
        {
            position: absolute;
            right: 25px;
            top: 7px;
            color: #727272;
        }

        .write-status {
            width: 100%;
            margin: auto;
            border-radius: 5px;
            display: flex;
            display: block;
            display: none;
            position: fixed;
            z-index: 2;
            top: 40%;
            max-width: 1143px;
            align-items: center;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            
        }

        .statusplace {
            margin: auto;
            margin-bottom: auto;
            width: 50%;
            display: none;
            background: white;
            border-radius: 10px;
            /* box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9); */
            /* padding: 20px; */
            box-sizing: border-box;
            margin-bottom: 28px;
        }

        .usernameIcon_statusplace{
            font-size: 25px;
            /* color: green; */
            margin-left: 4px;
        }

        .statusplace_body{
            padding:20px;
            padding-bottom: 12px;
        }

        .username_statusplace{
            font-size: 23px;
            margin-left: 10px;
        }

        .status {
            height: 87px;
        }

        /* Default style for the post button */
        .submitbtn {
            width: 531px;
            height: 45px;
            border-radius: 8px;
            background: #ccc; /* Default background color */
            color: white;
            border: none;
            font-size: 17px;
            cursor: pointer;
        }

        .submitbtn.text-present-hover
        {
            background:rgb(21,67,96);
            transition:0.3s;
        }

        /* Hover effect when there is text in the text area */
        .submitbtn.text-present-hover:hover {
            background-color: rgb(40, 93, 127); /* Change background color to green */
        }  

        .submitbtn.disabled-hover{
            background:#ccc;
        }

        /* Disabled hover effect */
        .submitbtn.disabled-hover:hover {
            background-color: #ccc; /* Disable hover effect by inheriting parent's background color */
            cursor: not-allowed; /* Change cursor to default when button is disabled */
            transition:0s;
        }



        .postarea {
            margin: auto;
            background: white;
            width: 50%;
            border-radius: 10px;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
        }

        .c_list{
            background: white;
            border: 1px solid rgb(183, 185, 190);
            padding: 4px;
            border-radius: 5px;
            margin-left: 32px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .userFeedBackAddIdea{
            margin: 0;
            margin-left: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
            border-radius: 10px 10px 0px 0px;
            text-align: center;
            border-bottom: 2px solid #D0D4DD;
            width: 549px;
            margin-left: 10px;
            
        }

        .userFeedHead{
            background: #11468F;
            margin: 0;
            padding-top: 15px;
            padding-bottom: 15px;
            border-radius: 10px 10px 0px 0px;
            text-align: center;
            color: white;
        }

        .userFeedBackBtn{
            color: #6f726f;
            display: flex;
            left: 0px;
            position: absolute;
            right: 319px;
            top: 16px;
            font-size: 38px;
            width: 38px;
            left: 803px;
            background: #C5C5C5;
            border-radius: 195%;
            text-align: center;
            height: 38px;
            transition:0.2s;
            cursor: pointer;
        }

        .userFeedBackBtn:hover{
            background: #6f726f;
            color:#C5C5C5;
        }

        .infotext {
            font-size: 20px;
            margin-top: 264px;
        }
        
            
        .ideatitle
        {
            text-align:center;
            font-size: 20px;
            color:red;
        }

        .username_postContainer{
            color: #11468F;
            font-weight: bold;
            font-size: 21px;
            margin-left: 5px;
        }

        .textplace
        {
        max-width: 355px; 
        white-space: normal;
        word-wrap: break-word;
        }

        .dateBox{

        }

        .userIcon{

        }

        .select_category h1{
            padding: 15px 0px;
            border-bottom: 1px solid gray;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 1px solid #D0D4DD;
            margin: 0px;
            margin-bottom: 0px;
            margin-bottom: 23px;
        }

        .select_category
        {
            /* width: 324px; */
            margin: auto;
            float: right;
            background: white;
            height: 158px;
            display: ab;
            position: absolute;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
            box-sizing: border-box;
            padding: 10px;
            padding-top: 0px;
            /* right: 48px;
            top: 167px; */
            border-radius: 10px;
            /* text-align: center; */

            left: 48px;
            top: 170px;
            width:356px;
            width: 18.5%;
        }

        .write-status {
            display: block; /* Initially display the write status place */
        }

        .hidden {
            display: none; /* Hide the write status place */
        }

        .showclosuredate{
            display: inline-block;
            box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
            box-sizing: border-box;
            margin-left: 19px;
            border-radius: 10px;
            width: 354px;
            height: 120px;
            position: absolute;
            height: 165px;
            /* left: 37px;
            top: 170px; */

            left: 29px;
            top: 380px;
            width: 18.5%;
        }

        .showclosuredate h1{
            border-radius: 10px 10px 0px 0px;
            margin: 0px;
            text-align: center;
            padding-top: 13px;
            padding-bottom: 13px;
            border-bottom: 1px solid #D0D4DD;
            margin: 0px 10px;
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
}


        .text1{
            left: 8.6%;  
        }

        .text2{
            left: 38%;
        }

        .text3{
            left: 66%;
        }

        .showclosuredate p{

        }
/* 
        .showclosuredate h1{
            background-color: #D0D4DD;
            border-radius: 10px 10px 0px 0px;
            margin: 0px;
            text-align: center;
            padding-top: 15px;
            padding-bottom: 15px;
        } */

        .addPostPlace{
            background: #D0D4DD;
            height: 74px;
            width: 550px;
            margin-left: 258px;
            margin-bottom: 28px;
            border-radius: 10px;
            margin: auto;
            margin-bottom: auto;
            margin-bottom: auto;
            margin-bottom: auto;
            margin-bottom: 33px;
            width: 50%;
            padding-left: 20px;
            padding-top: 14px;
            text-align: center;
        }

        .userIcon{
            display: inline-block;
            background: #11468F;
            color: white;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            box-sizing: border-box;
            padding: 7px;
            margin-right: 11px;
            font-size: 19px;
        }

        .btnIdea{
            width: 82%;
            height: 41px;
            text-align: left;
            padding: 6px;
            padding-left: 6px;
            box-sizing: border-box;
            border-radius: 26px;
            border: 1px solid rgba(183, 185, 190,0);
            padding-left: 19px;
            margin-top: 11px;
            /* margin-left: 66px; */
            color: rgb(93, 93, 93);
            cursor: pointer;
        }

        .btnIdea:hover{
            background-color:#fafafa ;
        }


        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .anonymous{
            margin-left: 30px;
            cursor: pointer;
        }

        .pagination-btn {
            display: inline-block;
            padding: 10px 14px;
            margin: 0 4px;
            border: 1px solid #11468F;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
            border-radius: 50%;
            transition: 0.2s;
            box-sizing: border-box;
            width: 40px;
            height: 40px;         
        }

        .pagination-btn-se{
            display: inline-block;
            padding: 10px 16px;
            height: 41px;
            margin: 0 4px;
            border: 1px solid #11468F;
            border-radius: 22px;
            text-decoration: none;
            color: #333;
            box-sizing: border-box;
            width: 102px;
            transition: 0.2s;
        }

        .pagination-btn-se:hover{
            background-color: #11468F;
            color: white;
        }


        .texts{
            border-top: 1px solid #AAA;
            padding-top: 22px;
            width: 96%;
        }

        .pagination-btn:hover {
            background-color: #11468F;
            color: white;
        }

        .pagination-btn.active {
            background-color: #11468F;
            color: white;
            border-color: #007bff;
        }

        .userfile{
            margin-left: 1px;
            cursor: pointer;
        }

        .categoryLabel{
            margin-left: 10px;
            margin-right: 24px;
        }

        .postCat{
            width: 183px;
            height: 28px;
            background: white;
            border: 1px solid gray;
            border-radius: 5px;
            padding: 5px;
        }

        .actionbtn{
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

        .actionbtn:hover{
            /* background-color: #727272; */
            bottom: -22px;
            /* border: 2px solid #727272; */
            border: 1px solid #11468F;
        }

        .likebtn{
            left: 13.5%;
        }

        .unlikebtn{
            left: 43%;
        }

        .commentbtn{
            left: 71%;
        }


        .likebtn.liked,
        .unlikebtn.unliked {
            background: #727272;
            background: #11468F;
            color: white;
        }

        .contentPlace{
            margin-bottom: 28px;
        }

        .contentPlaceNoDoc{
            margin-bottom: 50px;
            margin-top: 13px;
        }

        .closureDate{
            color:#11468F;
            margin-left: 44px;
        }

        .finalClosureDate{
            color:#11468F;
            margin-left: 10px;
        }

        /* iPad Air */
        @media (max-width: 820px) {
            .container {
                margin-bottom: 300px;
            }
        }

        @media screen and (max-width: 1280px) { 
            .btnIdea{
                width: 70%;
            }

            .userIcon{
                margin-right: 13px;
            }

            .actionbtn{
                width: 65px;
            }

            .likebtn{
                left: 8%;
            }

            .unlikebtn{
                left: 41%;
            }

            .commentbtn{
                left: 73%;
            }

            .text1{
                left: -1%;
            }

            .text2{
                left: 31%;
            }

            .text3{
                left: 63%;
            }

            .upperpart{
                margin-bottom:5px
            }

            .category{
                top: 57px;
                left: 21px;
            }

            .contentPlace{
                margin-bottom: 15px;
                margin-top: 7px;
            }

            .contentPlaceNoDoc{
                margin-bottom: 34px;
                margin-top: 13px;
            }

            .select_category{
                height: 168px;
            }

            .categoryLabel{
                margin-left: 0px;
            }

            .postCat{
                margin-top: 10px;
                width: 99%;
            }

            .closureDate{
                margin-left: 0px;
                width: 81%;
                display: block;
                margin-top: 10px;
                margin-bottom: 28px;
            }

            .finalClosureDate{
                margin-left: 0px;
                width: 81%;
                display: block;
                margin-top: 10px;
            }
            .showclosuredate{
                height: 230px;
            }
        }

        @media screen and (max-width: 1867px) { 

            .postCat{
                margin-top: 10px;
                width: 99%;
            }

            .closureDate{
                display: block;
                margin-left: 0px;
                margin-top: 10px;
            }

            .showclosuredate{
                height: 217px;
            }

            .finalClosureDate{
                display: block;
                margin-left: 0px;
                margin-top: 10px;
            }

        }

        @media screen and (max-width: 1200px) { 
            .userFeedBackBtn{
                left: 69.5%;
            }
            .showclosuredate {
                height: 260px;
            }
    }
        @media screen and (max-width: 1180px) { 
            .userFeedBackBtn {
                left: 69.5%;
            }

        .showclosuredate {
            height: 267px;
        }

        .userFeedBackAddIdea{
            width: 96.3%;
        }

        textarea{
            width: 101.7%;
        }

        .submitbtn{
            width: 101.7%;
        }

        .userfile{
            widtH:161px;
        }

        }  

        @media screen and (max-width: 1670px) { 

            .category{
                top: 57px;
                left: 21px;
            }

        }   

        @media screen and (max-width: 1090px) {

            .addPostPlace{
                width: 80%;
            }
            .post-container{
                width: 80%;
            }

            .postarea{
                margin-left: 36%;
            }

            .select_category{
                width: 24.5%;
            }

            .showclosuredate 
            {
                width: 24.5%;
            }

        }

        @media screen and (max-width: 800px) { 

            .userFeedBackBtn {
    left: 86.5%;
  }

            .statusplace{
                width: 89%;
            }
            

            .showclosuredate{
                left:3px;
                width:20%;
            }

            .select_category{
                left:22px;
                width:20.5%;
            }

            .postCat{
                width: 99%;
            }

            .closureDate{
                width:133px;
            }

            .finalClosureDate{
                width:133px;
            }

            .showclosuredate{
                height:263px;
            }

            .addPostPlace{
                width:83%;
            }

            .post-container{
                width:83%;
            }

            .likebtn{
                left: 10%;
            }

            .unlikebtn{
                left: 40%;
            }

            .commentbtn{
                left: 72%;
            }

            .text1{
                left: -1%;
            }

            .text2{
                left: 31%;
            }

            .text3{
                left: 63%;
            }
        }

        @media screen and (max-width: 800px) { 
           .postarea{
            margin-left: 41%;
            width: 57%;
           }

           .showclosuredate{
            width: 30%;
           }
           
           .select_category{
            width: 30.5%;
           }
        }

        @media screen and (max-width: 572px) { 
            .select_category {
                width: 91.5%;
                left: 22px;
                height: 168px;
                top: 156px;
            }

            .postarea{
                margin-top: 173px;
                margin-left: 0%;
                width: 98%;
            }

            .showclosuredate{
                width: 82%;
                left: 73px;
            }

            .closureDate{
                margin-left: 85px;
                display: inline;
            }

            .finalClosureDate {
                margin-left: 52px;
                display: inline;
            }

            .addPostPlace {
                width: 83%;
                margin-top: 94px;
            }

            .showclosuredate h1 {
                display: none;
            }

            .showclosuredate{
                top: 427px;
                width: 69%;
                height: 89px;
                box-shadow: none;
            }
        }

        @media screen and (max-width: 572px) { 
            .closureDate{
                margin-left: 44px;
            }

            .finalClosureDate{
                margin-left: 11px;
            }

            .showclosuredate{
                top: 443px;
                left: 10%;
            }

            .postarea{
                margin-top: 191px;
            }

            .select_category{
                width: 95.5%;
                left: 9px;
            }


        }

        @media screen and (max-width: 463px) { 

            .userFeedBackBtn {
                left: 84.5%;
            }
            .showclosuredate{
                width: 74%;
            }

            .showclosuredate {
                top: 443px;
                left: 7%;
            } 

        }

        @media screen and (max-width: 437px) { 
            .showclosuredate{
                width: 80%;
            }

            .showclosuredate {
                top: 443px;
                left: 3%;
            } 

            .pagination-btn-se{
                padding: 11px 16px;
                font-size: 11px;
                height: 37px;
                width: 84px;
                /* background-color: green; */
            }

            .pagination-btn{
                margin:0px ;
                width: 33px;
                height: 33px;
                padding: 6px 10px;
                font-size: 14px;
            }

        }

        @media screen and (max-width: 399px) { 

            .userFeedBackBtn {
                left: 81.5%;
            }

            .userfile {
                margin-top: 8px;
            }

            .c_list{
                display: block;
                width: 100%;
                margin-top: 9px;
                margin-left: 0px;
                margin-bottom: 0px;
            }

            .closureDate {
                margin-left: 0px;
                display: block;
                width: 187px;
                margin-bottom: 22px;
            }

            .finalClosureDate{
                margin-left: 0px;
                display: block;
                width: 187px;
            }

            .showclosuredate{
                top: 435px;
            }

            .addPostPlace{
                margin-top: 132px;
            }



        }


    </style>

<script>
        <?php include 'staffFeed.js'?>
    </script>
</head>
<body>
<?php include("../controller/alertBox.php")?>
    <?php include 'navbar.php' ?>   
     
 <div class="showclosuredate">
    <h1>Time</h1>
<div class="dateBox" style="/*! background: green; */margin-left: 20px;margin-bottom: 20px;">
<?php  
if ($row_count > 0) 
{?>
    <p>Closure Date: <strong><span class="closureDate"><?php echo $closureDate?></span></strong></p>
    <p>Final Closure Date: <strong><span class="finalClosureDate"><?php echo $finalClosureDate?></span></strong></p>
<?php
}else
{?>
    <p >Closure Date: <strong><span style="color:#11468F;margin-left: 44px;">['Not Set']</span></strong></p>
    <p >Final Closure Date: <strong><span style="color:#11468F;margin-left: 10px;">['Not Set']</span></strong></p>
<?php
}
?>
</div>
 </div>

    <?php
if ($row_count > 0) 
{        $date1 = DateTime::createFromFormat('F j, Y, g:i a', $currentDate);
        $date2 = DateTime::createFromFormat('F j, Y, g:i a', $closureDate);
    
if ($date1 < $date2) {
?>
    <div class="backFilter" id="backFilter">

    </div>
    <div class="write-status">
    
        <form class="statusplace" id="statusplace" action="../controller/stafffeedcontroller.php" method="post" enctype="multipart/form-data">
            <h1 class="userFeedBackAddIdea">New Idea
            <i class="fa-solid fa-circle-xmark userFeedBackBtn" id="btnBackNewIdea"></i>

            </h1>
            
            <div class="statusplace_body">
            <label for="postContent"><i class="fa-solid fa-user icon usernameIcon_statusplace" ></i>&nbsp;<label class="username_statusplace"><?php echo $_SESSION['username'] ?></label></label><br>
            <br>
            <div class="status">
                <textarea name="postContent" rows="4" cols="60" id="postContent"  placeholder="What's on your mind, <?php echo $_SESSION["username"] ?>?"></textarea>
            </div><br>
            <label for="category"><strong>Choose Category : </strong></label>
            <select name="category_list" class="c_list">
                <?php
                // Fetch categories from the database
                $sqlCategories = "SELECT * FROM category";
                $stmtCategories = $conn->prepare($sqlCategories);
                $stmtCategories->execute();
                $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

                // Loop through categories to generate options
                foreach ($categories as $cat) {
                    echo "<option value=\"{$cat['name']}\">{$cat['name']}</option>";
                }
                ?>
            </select><br>
            
            <label for="anonymous"><strong>Post Anonymously</strong></label>
            <input type="checkbox" class="anonymous" id="anonymous" name="anonymous">
            <br><br>
            
            <label for="userfile"><strong>File Upload (Optional): </strong></label>
            <input type="file" name="userfile" class="userfile"><br><br>
            
            <input type="submit" value="Post" name="submit" id="btnSubmit" class="submitbtn">
            </div>
        </form>
    </div>
<?php
}
}?>
<div class="select_category">
    <h1>Category</h1>
    <label for="category" class="categoryLabel">Select Category: </label>
    <select id="category" class="postCat" name="category" onchange="filterPosts()" s>
    <option value="all" <?php echo ($category == 'all') ? 'selected' : ''; ?>>All</option>
    <?php
    // Fetch categories from the database
    $sqlCategories = "SELECT * FROM category";
    $stmtCategories = $conn->prepare($sqlCategories);
    $stmtCategories->execute();
    $categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

    // Loop through categories to generate options
    foreach ($categories as $cat) {
        // Check if this option matches the currently selected category
        $selected = ($category == $cat['name']) ? 'selected="selected"' : '';
        echo "<option value=\"{$cat['name']}\" {$selected}>{$cat['name']}</option>";
    }
    ?>
    <option value="popular" <?php echo ($category == 'popular') ? 'selected' : ''; ?>>Most Popular Ideas</option>
    <option value="most_viewed" <?php echo ($category == 'most_viewed') ? 'selected' : ''; ?>>Most Viewed Ideas</option>
</select>

</div>


        <script>
            function filterPosts() {
                var category = document.getElementById("category").value;
                window.location.href = "feed.php?category=" + category;
            }
        </script>
        </form>
    </div>
    <br><br>
    <div class="postarea">
        <!-- <br> -->
        <center><h1 class="userFeedHead">Users' Feed</h1></center>
        <br><br>

        <div class="addPostPlace">
            <div class="userIcon"><i class="fa-solid fa-user"></i></div>
            <button class="btnIdea" id="btnIdea">Is there any idea, <?php echo $_SESSION["username"]?>?
            </button>
        </div>
        <?php
        if ($results && count($results) > 0) {
            foreach ($results as $key => $row) {

                if ($row['Post_Anno'] === 'Yes') {
                    $username = "Post by Anonymous";
                } else {
                    $username = $row['username'];
                }


                $post_id = $row['id'];
                $sqlCheckLike = "SELECT COUNT(*) AS like_count_alias FROM user_post_likes WHERE user_id = :user_id AND post_id = :post_id";
                $stmtCheckLike = $conn->prepare($sqlCheckLike);
                $stmtCheckLike->bindParam(':user_id', $id);
                $stmtCheckLike->bindParam(':post_id', $post_id);
                $stmtCheckLike->execute();
                $rowLike = $stmtCheckLike->fetch(PDO::FETCH_ASSOC);
                $userLiked = ($rowLike && $rowLike['like_count_alias'] > 0);


                $sqlCheckUnlike = "SELECT COUNT(*) AS unlike_count_alias FROM user_post_unlikes WHERE user_id = :user_id AND post_id = :post_id";
                $stmtCheckUnlike = $conn->prepare($sqlCheckUnlike);
                $stmtCheckUnlike->bindParam(':user_id', $id);
                $stmtCheckUnlike->bindParam(':post_id', $post_id);
                $stmtCheckUnlike->execute();
                $rowUnlike = $stmtCheckUnlike->fetch(PDO::FETCH_ASSOC);
                $userUnliked = ($rowUnlike && $rowUnlike['unlike_count_alias'] > 0);
        ?>
                <div class="post">
                <div class="post-container">
                    <br>
                    <div class="textplace upperpart"><i class="fa-solid fa-user icon" style="font-size: 18px;"></i>&nbsp;<label class="username_postContainer"><?php echo $username ?></label><p class="date"><?php echo timeAgo($row['date_created']) ?></p></div>
                    <br><br>
                    <div class="category">For : <?php echo $row['category'] ?></div>
                    <?php if (!empty($row['file'])) : ?>
                        <div class="textplace contentPlace" style="padding-left: 14px;"><?php echo $row['content'] ?></div>
                        <div><a href="../userfiles/<?php echo $row['file']; ?>" download="idea support">Document</a></div><br>
                        <div class="texts">
                            <label class="text1 textAll"><i class="fa-solid fa-thumbs-up"></i> : <td ><?php echo $row['like_count'] ?></td></label>
                            <label class="text2 textAll"><i class="fa-solid fa-thumbs-down"></i> : <td ><?php echo $row['unlike_count']; ?></td></label>
                            <label class="text3 textAll"><td ><i class="fa-solid fa-comment"></i> : <?php echo $row['comment_count']; ?></td>
                            </label>
                        </div>
                        <br>
                        <div class="buttons">
                            <form action="../controller/stafffeedcontroller.php" method="post">
                                <button value="like" name="like" class="likebtn actionbtn  <?php echo ($userLiked ? 'liked' : ''); ?>">Like</button>
                                <button value="unlike" name="unlike" class="unlikebtn actionbtn  <?php echo ($userUnliked ? 'unliked' : ''); ?>">Unlike</button>
                                <button value="comment" name="comment" class="commentbtn actionbtn">Comment</button>
                                <input type="hidden" name="post_id" value="<?php echo $row['id'] ?>">
            

                            </form>
                        </div>
                    <?php else: ?>
                        <div class="textplace contentPlaceNoDoc" style="padding-left: 14px;"><?php echo $row['content'] ?></div>
                        <div class="texts">
                            <label class="text1 textAll"><td><i class="fa-solid fa-thumbs-up"></i> : <?php echo $row['like_count'] ?></td></label>
                            <label class="text2 textAll"><i class="fa-solid fa-thumbs-down"></i> : <td class="text2 textAll"><?php echo $row['unlike_count']; ?></td></label>
                            <label class="text3 textAll"><i class="fa-solid fa-comment"></i> : <td class="text3 textAll"><?php echo $row['comment_count']; ?></td></label>
                        </div>
                        <br>
                        <div class="buttons">
                            <form action="../controller/stafffeedcontroller.php" method="post">
                                <button value="like" name="like" class="likebtn actionbtn <?php echo ($userLiked ? 'liked' : ''); ?>">Like</button>
                                <button value="unlike" name="unlike" class="unlikebtn actionbtn <?php echo ($userUnliked ? 'unliked' : ''); ?>">Unlike</button>
                                <button value="comment" name="comment" class="commentbtn actionbtn">Comment</button>
                                <input type="hidden" name="post_id" value="<?php echo $row['id'] ?>">
                            </form>
                        </div>
                    <?php endif; ?>
                    <br>
                </div>
            </div>
            <br><br><br>
    <?php
        }
    } else {
            echo "<center><p class='infotext'>\"No posts available\"</p></center><br><br>";
        }
        ?>
    <div class="pagination">
        <?php
            $sqlCount = "SELECT COUNT(*) AS total FROM ideas";
            $stmtCount = $conn->prepare($sqlCount);
            $stmtCount->execute();
            $rowTotal = $stmtCount->fetch(PDO::FETCH_ASSOC);
            $totalPages = ceil($rowTotal['total'] / $limit); 
            ?>
            <ul>

                <br><br>
            </ul>
        </div>
    </div>
    <center>
    <div class="pagination">
    <?php
    if ($page > 1): 
        $prevPageUrl = "?page=" . ($page - 1) . "&category=" . urlencode($category);
    ?>
        <a href="<?php echo $prevPageUrl; ?>" class="pagination-btn-se">&laquo; Previous</a>
    <?php endif; ?>
    
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php 
        $pageUrl = "?page=" . $i . "&category=" . urlencode($category);
        ?>
        <a href="<?php echo $pageUrl; ?>" class="pagination-btn <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
    
    <?php
    if ($page < $totalPages):
        $nextPageUrl = "?page=" . ($page + 1) . "&category=" . urlencode($category);
    ?>
        <a href="<?php echo $nextPageUrl; ?>" class="pagination-btn-se">Next &raquo;</a>
    <?php endif; ?>
</div>
    </center>
    <br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
