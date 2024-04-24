<!DOCTYPE html>
<html lang="en">
<head>
    <?php session_start()?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">
          <style>

body {
    font:"Arial Rounded MT Bold";
    background: white;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;

    /* Set background image */
    background-image: url('../images/login.jpg'); /* Replace 'background.jpg' with the path to your image */
    background-size: cover; /* Cover the entire viewport */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Do not repeat the background image */
    height: 100vh; /* Set the height of the body to 100% of the viewport height */
}

.loginform {
    font-family: "Corbel";
    /* max-width: 400px; */
    width: 100%;
    padding: 20px;
    height: 500px; 
    
}

a {
    text-decoration: none;
}

.card h2{
    font-weight: bold;
    caret-color: transparent;
}

.card {
    border-radius: 1rem;
    backdrop-filter: blur(7px);
    background-color: rgba(227, 227, 227, 0.5);
    /* background-color: rgba(187, 236, 255, 0.5); */
    width: 375px;
    max-width: none;
    height: 463px;
    border: none;
    color:rgb(21,67,96);
}

.input_field{
    background-color: rgba(227, 227, 227, 0);
    border: none;
    border-bottom-width: medium;
    border-bottom-style: none;
    border-bottom-color: currentcolor;
    border-bottom: 2px solid rgb(21,67,96);
    border-radius: 0px;
    margin-top: 43px;
}

.input_field:focus{
    background-color: rgba(227, 227, 227, 0);
    border: none;
    border-bottom-width: medium;
    border-bottom-style: none;
    border-bottom-color: currentcolor;
    border-bottom: 2px solid rgb(21,67,96);
    border-radius: 0px;
    margin-top: 43px;
    outline: none;
}

.option{
    color: white;
    font-weight: bold;
    text-decoration: none;
    position: absolute;
    left: 31px;
    top: 12px;
    transition: 0.4s;
    width: 104px;
    height: 33px;
    text-align: center;
    padding-top: 1px;
    border-radius: 9px;
    border: 2px solid white;
    border-bottom-width: 2px;
    border-bottom-style: solid;
    border-bottom-color: white;
}

.option:hover{
    color: rgb(21,67,96);
    font-weight: bold;
    text-decoration: none;
    position: absolute;
    left: 31px;
    border: 2px solid rgb(21,67,96);
}

.login {
    /* color: black; */
}

.register_words{
    margin-top: 36px;
    caret-color: transparent;
}

.register_words a{

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
    border-radius: 6px;
    border: none;
    background: black;
    color: white;
    width: 100%;
    cursor: pointer;
    margin-top: 36px;
    background:rgb(21,67,96);
    transition: 0.5s;
    font-weight: bold;
}

.icon{
    font-size: 19px;
    right: 57px;
}

.icon1{
    position: absolute;
    bottom: 298px;
}

.icon2{
    position: absolute;
    bottom: 204px;
}

.submitbtn:hover {
    background: white;
    color: rgb(21,67,96);
    font-weight: bold;
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
<?php include("../controller/alertBox.php")?>
<a class="option" href="../useroptions/userOptions.php">OPTION</a>
<form action="../controller/qacologincontroller.php" method="post">
    <section class="loginform">
        <div class="container h-100">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="card">
                    <div class="card-body p-5 text-center">
                        <h2 class="login">Login</h2>
                        <div class="form-outline form-white mb-4">
                            <!-- <label class="form-label" for="typeEmailX">Enter Email</label> -->
                            <i class="icon icon1 fa-solid fa-envelope"></i>
                            <input type="email" name="email" class="input_field form-control form-control-lg" required placeholder="Email"/>
                        </div>
                        <div class="form-outline form-white mb-4">
                            <!-- <label class="form-label" for="typePasswordX">Enter Password</label> -->
                            <i class="icon icon2 fa-solid fa-lock"></i> 
                            <input type="password" name="password" class="input_field form-control form-control-lg" placeholder="Password" required/>
                        </div>
                        <p class="register_words mb-0">Don't have an account? <a href="signupForm.php">Register</a></p>
                        <button class="submitbtn" type="submit" name="login">Login</button>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
</body>
</html>
