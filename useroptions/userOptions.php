<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose User Type</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome for the logo -->
    <style>
        body {
            background-color: skyblue;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Center items vertically */
            height: 100vh;
            margin: 0;
        }

        .logo {
            font-size: 48px; /* Adjust the size as needed */
            color:red; /* Set the color to red */
        }

        .welcome-text {
            font-size: 30px; /* Adjust the size as needed */
            margin: 20px 0; /* Add margin for spacing */
        }

        .panel-container {
            text-align: center;
        }

        .panel {
            background-color: grey;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 90%;
            margin-top: 20px; /* Add margin to separate the title and panel */
        }

        .link {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .link:hover {
            background-color: white;
            color: black;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .panel {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <i class="fab fa-phoenix-framework"></i>
    </div>
    <div class="welcome-text">
        Welcome to Phoenix English Private School
    </div>
    <div class="panel-container">
        <h2>Choose User Type:</h2>
        <div class="panel">
            <a href="../admin/dashboard.php" class="link">Admin</a>
            <a href="../student/enrollmentForm.php" class="link">Student</a>
        </div>
    </div>
</body>
</html>
