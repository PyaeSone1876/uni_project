<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Options</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
body
{
    background:skyblue;
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
            padding:0.5rem 3rem 0.5rem 3rem;
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
            color:red;
        }

        .logo
        {
            font-size:70px;
            color:orange;
        }


        .container
        {
            text-align:center;
        }



    </style>
</head>
<body>

<h1 class="title"><br>
<i class="fa-brands fa-phoenix-framework logo"></i>
<br><br>
Welcome to <span class="schname">'Phoenix'</span> English Private School</h1>
<br><br><br>
<div class="container">
<div class="panel">
<h2>Choose User:</h2>
    <a href="../admin/dashboard.php" class="admin" id="buttons">Admin</a>
    <br><br><br>
    <a href="../student/enrollmentForm.php" class="student" id="buttons">Student</a>
</div>
</div>
</body>
</html>