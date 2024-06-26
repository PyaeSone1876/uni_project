<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose User Type</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome for the logo -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /* Center items vertically */
    height: 100vh;
    margin: 0;
    font-family: 'Calibri';
    color: rgb(21, 67, 96);
    caret-color: transparent;
}

.logoBox {}

.logo {
    font-size: 48px;
    /* Adjust the size as needed */
    color: red;
    /* Set the color to red */
    text-align: center;
}

.welcome-text {
    font-size: 30px;
    /* Adjust the size as needed */
    margin: 20px 0;
    /* Add margin for spacing */
}

h3 {
    margin-top: 21px;
    margin-bottom: 4px;
    font-weight: lighter;
    font-size: 24px;
}

h2 {
    margin-bottom: 0px;
    margin-top: 0px;
    font-size: 43px;
    text-transform: uppercase;
    font-family: "Arial Rounded MT Bold";
}

.panel-container {
    text-align: center;
    width: 100%;
}

.panel {
    border-radius: 10px;
    text-align: center;
    width: 100%;
    margin-top: 20px;
    display: flex;
    height: he;
    justify-content: space-evenly;
    align-items: center;
    margin-top: 0px;
    padding-top: 0px;
    flex-wrap: wrap;
    margin: 0px;
    margin-top: 44px;
    height: auto;
    /* background: green; */
    min-height: 248px;
}

.link {
    background-color: white;
    color: rgb(21, 67, 96);
    padding: 10px 20px;
    border-radius: 18px;
    margin: 5px;
    text-decoration: none;
    display: inline-block;
    height: 160px;
    width: 160px;
    justify-content: center;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 0px 14px rgba(96, 206, 128, 0.9);
    transition: 0.3s, margin 0.4s;
    border: 2px solid rgba(96, 206, 128, 0.4);
    flex-direction: column;
    font-family: Arial;
    position: relative;
    transition: 0.3s;
    top: 0px;
}

a i {
    font-size: 90px;
    margin-bottom: 20px;
}

.link:hover {
    background-color: rgba(96, 206, 128);
    color: white;
    border: 2px solid rgba(96, 206, 128, 0.0);
    box-shadow: 0px 0px 14px rgba(96, 206, 128, 0.9);
    top: 30px;
    width: 160px;
}

@media (max-width: 860px) {
    .panel {
        min-height: 450px;
        margin: auto;
        width: 95%;
    }
    .link {
        width: 220px;
    }
}

@media (max-width: 768px) {
    .panel {
        max-width: 100%;
    }
}

@media (max-width: 568px) {
    h2 {
        font-size: 27px;
    }
    .panel {
        height: 687px;
    }
    .link {
        width: 405px;
        height: 120px;
    }
    .link i {}
    .link label {}
    .link:hover {
        top: 10px;
    }
    .welcome-text {
        font-size: 30px;
        margin: 20px 0;
        text-align: center;
    }
}


/* @media(max-height: 870px) {
    .panel {
        height: 590px;
    }
    .welcome-text {
        font-size: 30px;
        margin: 20px 0;
        text-align: center;
        margin: 0px;
    }
    .panel {
        height: 590px;
    }
} */
    </style>
</head>
<body>
    <div class="logoBox">
    <div class="logo">
        <i class="fab fa-phoenix-framework"></i>
    </div>
    <div class="welcome-text">
        Welcome to University System 
    </div>
    </div>
    <div class="panel-container">
        <h2>Choose User Type:</h2>
        <div class="panel">

            <!-- <a href="../admin/feed.php" class="link">

            <i class="fa-solid fa-book-open-reader"></i>
            <a href="../admin/feed.php" class="link">Admin</a>
            <a href="../qamanager/feed.php" class="link">QA Manager</a>
            <a href="../qacoordinator/feed.php" class="link">QA Coordinator</a>
            <a href="../staff/feed.php" class="link">Staff</a> -->

            <a href="../admin/feed.php" class="link">

            <i class="fa-solid fa-book-open-reader"></i>
            <label for="">Admin</label></a>
            <a href="../qamanager/feed.php" class="link">
            <i class="fa-solid fa-user-tie"></i>
            <label for="">QA Manager</label></a>
            <a href="../qacoordinator/feed.php" class="link">
            <i class="fa-solid fa-user-tie"></i>
            <label for="">QA Coordinator</label>
            </a>
            <a href="../staff/feed.php" class="link">
            <i class="fa-solid fa-user"></i>
            <label for="">Staff</label></a>

        </div>
    </div>
</body>
</html>
