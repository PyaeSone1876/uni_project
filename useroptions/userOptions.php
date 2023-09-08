<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
    
}


a
{
    text-decoration:none;
}

.panel
{
    width:500px;
    height:1000px;
    background:wheat;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    width:300px;
    height:300px;
    padding-top:100px;
    border-radius:50px;
    text-align:center;
    margin-left:480px;
}

.title
{
    text-align:center;

}





        #buttons
        {
          
            height:1rem;
            padding:0.5rem 1rem 0.5rem 1rem;
            background-color: black;
            color:white;
            border: none;
            border-radius: 5px;
        }

        #buttons:hover {
            background-color: white;
            color:black;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .title
        {
            color:black;
        }

        .schname
        {
            color:orange;
        }



    </style>
</head>
<body>
<h1 class="title">Welcome to <span class="schname">'Phoenix'</span> English Private School</h1>
<br><br><br>
<div class="container">
<div class="panel">
<h1>Choose User</h1>
    <a href="../admin/dashboard.php" class="admin" id="buttons">Admin</a>
    <br><br>
    <a href="../student/enrollmentForm.php" class="student" id="buttons">Student</a>
</div>
</div>
</body>
</html>