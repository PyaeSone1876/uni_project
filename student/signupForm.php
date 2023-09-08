
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
body
{
  background:wheat;
}
a
{
  text-decoration:none;
}

.card
{
  background:skyblue;
  height:57rem;
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

@media (max-width:1035px) {

header
{
    padding-right:40rem;
}

nav li a
{
    font-size:12px;
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
<form action="../controller/signupcontroller.php" method="post">
<section class="signupform">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="login">Sign Up Form</h2>
              <br>
              <br>

              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Username</label>
              <input type="text" class="form-control form-control-lg" name="username"/>
              </div>
              
              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Email</label>
              <input type="email" class="form-control form-control-lg" name="email"/>
              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Address</label>
              <input type="text" class="form-control form-control-lg" name="address"/>  
              </div>

              
              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Phone Number</label>
              <input type="text" class="form-control form-control-lg" name="phnumber"/>  
              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Password</label>
              <input type="password" class="form-control form-control-lg" name="password"/>  
              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label">Enter Confirm Password</label>
              <input type="password" class="form-control form-control-lg" name="cpassword"/>  
              </div>
            <br>
              <button class="submitbtn" type="submit" name="signup">Sign Up</button>


            </div>

       

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</form>
</body>
</html>