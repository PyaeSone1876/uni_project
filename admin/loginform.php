
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>

.loginform {

background: wheat;
height: 125vh;
font-family:Times New Roman;
}


a
{
  text-decoration:none;
}

.card
{
  background:skyblue;
  height: 37rem;
}

.login
{
  color:black;
}

.newuser
{
  color:black;
}

.newuser:hover
{
  color:white;
  text-decoration:none;
}

.submitbtn
{
  padding:0.5rem 2rem 0.5rem 2rem;
  border-radius:1rem;
  border:none;
}

.submitbtn:hover
{
  color:white;
  background:black;
  cursor:pointer;
}

  </style>
</head>
<body>
<section class="loginform">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <form action="../controller/logincontroller.php" method="post">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="login">Login Form</h2>
              <br>
              <br>
              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typeEmailX">Enter Email</label>
                <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email">
                
              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX">Enter Password</label>
                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password">
                
              </div>
            <br>
            <br>
              <button class="submitbtn" type="submit" name="login">Login</button>


            </div>

       

          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</section>
</body>
</html>