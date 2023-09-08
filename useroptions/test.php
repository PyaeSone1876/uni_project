<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
    <style>
        body {
            background: wheat;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .loginform {
            font-family: Times New Roman;
            max-width: 400px; /* Adjust the maximum width as needed */
            width: 100%;
            padding: 20px;
            height: 500px; /* Fixed height */
        }

        a {
            text-decoration: none;
        }

        .card {
            background: skyblue;
            height: 100%; /* Adjust the height to fill the container */
            border-radius: 1rem;
        }

        .login {
            color: black;
        }

        .newuser {
            color: black;
        }

        .newuser:hover {
            color: white;
            text-decoration: none;
        }

        .submitbtn {
            padding: 0.5rem 2rem;
            border-radius: 1rem;
            border: none;
            background: black;
            color: white;
            cursor: pointer;
        }

        .submitbtn:hover {
            background: white;
            color: black;
        }

        @media (max-width: 1035px) {
            header {
                padding-right: 40rem;
            }

            nav li a {
                font-size: 12px;
            }
        }

        @media screen and (min-width: 1024px) {
            header,
            nav,
            main,
            footer {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
<form action="../controller/studentlogincontroller.php" method="post">
    <section class="loginform">
        <div class="container h-100">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="card">
                    <div class="card-body p-5 text-center">
                        <h2 class="login">Login Form</h2>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typeEmailX">Enter Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" />
                        </div>
                        <div class="form-outline form-white mb-4">
                            <label class="form-label" for="typePasswordX">Enter Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" />
                        </div>
                        <p class="mb-0">Don't have an account? <a href="signupForm.php"
                                                                class="text-white-50 fw-bold">Sign Up</a></p>
                        <br>
                        <br>
                        <button class="submitbtn" type="submit" name="login">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>
