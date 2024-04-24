
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
  <style>
body
{
    min-height: 100vh;
    font-family: "Corbel";
    background:white;
    /* Set background image */
     background-image: url('../images/register.jpg'); /* Replace 'background.jpg' with the path to your image */
    background-size: cover; /* Cover the entire viewport */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Do not repeat the background image */
    /* height: 100vh; Set the height of the body to 100% of the viewport height */
}

a
{
  text-decoration:none;
}

.userName{

}

.email{

}

.address{

}


.slectDepartment{

}

.password{

}

.cPassword{

}

.boxG{
  /* background: green; */
  text-align: center;
  height: 90px;
  width: 462px;
  margin: auto;
  
}

.gobackbtn{
  font-weight: bold;
  text-decoration: none;
  position: absolute;
  left: 31px;
  top: 12px;
  transition: 0.4s;
  width: 134px;
  height: 41px;
  text-align: center;
  padding-top: 1px;
  border-radius: 9px;
  border: 2px solid rgb(27, 105, 40);
    border-bottom-width: 2px;
    border-bottom-style: solid;
  border-bottom-width: 2px;
  border-bottom-style: solid;
  background: none;
  color: rgb(27, 105, 40);
  cursor: pointer;
  font-family: "Corbel";
  font-weight: bold;
  font-size: 17px;
}

.gobackbtn:hover{
  /* color: rgb(128, 117, 55); */
  top: 15px;
  /* border: 2px solid rgb(128, 117, 55); */
}

.inputBox{
    border: none;
    border-bottom-width: medium;
    border-bottom-style: none;
    border-bottom-color: currentcolor;
    border-bottom: 2px solid rgb(32, 95, 42);
    border-radius: 0px;
    background: gray;
    height: 60px;
    width: 93%;
    margin-top: 0px;
    padding-left: 20px;
    box-sizing: border-box;
    margin-top: 20px;
    background: none;
    font-size: 20px;
    color: #495057;
}

.inputBox:focus{
  outline: none;
}

.card
{
  background:skyblue;
  height:60rem;
  word-wrap: break-word;
  width: 540px;
  margin: auto;
  height: 769px;
  margin-top: 37px;
  backdrop-filter: blur(7px);
  background-color: rgba(227, 227, 227, 0.5);
  text-align: center;
}


.card-body{
  padding: 10px 30px;
  margin-top: 83px;
}

.signupform {
  /* height: 618px; */
}

.login
{
  color: black;
  font-size: 34px;
  margin-top: 33px;
  margin-bottom: 13px;
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

.submitbtn{
  padding: 0.5rem 2rem;
  border-radius: 6px;
  border: none;
  background: black;
  color: white;
  width: 100%;
  cursor: pointer;
  margin-top: 36px;
  background: rgb(21,67,96);
  background:rgb(27, 105, 40);
  transition: 0.5s;
  font-weight: bold;
  height: 62px;
  margin-top: -5px;
  width: 91%;
  margin-top: 13px;
  font-size: 18px;
}

.submitbtn:hover {
  background: white;
  color: rgb(27, 105, 40);
  font-weight: bold;
}

.label_text{
  display: block;
  margin-bottom: 18px;
  margin-top: 18px;
  display: none;
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

@media (max-width:557px) {
.submitbtn{
  font-size: 18px;
}

.boxG{
  width: 364px;
  font-size: 13px;
}

.card{
  width: 422px;
}

}

@media (max-width:557px) {
  .card{
    width: 346px;
  }

  .inputBox{
    height: 60px;
    width: 93%;
  }

  .boxG{
    width: 288px;
    font-size: 13px;
  }

  .inputBox{
    font-size: 16px;
  }

  .submitbtn{
    margin-top: -7px;
  }
}

  </style>
</head>
<body>
<?php include("../controller/alertBox.php")?>
<form action="../controller/adminsignupcontroller.php" method="post">
<section class="signupform">
        <div class="card" style="border-radius: 1rem;">
          <div class="card-body text-center">

            <div class="mb-md-5 mt-md-4 pb-5 innerDiv">

              <h2 class="login">Sign Up Form</h2>
              <div class="userName boxG">
              <label class="label_text">Enter Username</label>
              <input type="text" placeholder="Username" class="inputBox" name="username" pattern="[A-Za-z\s]+" title="Input should only include letters." required/>
              </div>
              
              <div class="email boxG">
              <label class="label_text">Enter Email</label>
              <input type="email" class="inputBox" placeholder="Email" name="email" required/>
              </div>

              <div class="address boxG">
              <label class="label_text">Enter Address</label>
              <input type="text" placeholder="Address" class="inputBox" name="address" required/>  
              </div>
               
              <div class="slectDepartment boxG">
                        <label class="label_text">Select Department</label>
                        <select name="department" id="department" class="inputBox">
                            <option value="label_text">IT Department</option>
                            <option value="label_text">Student Department</option>
                            <option value="label_text">Finance Department</option>
                            <option value="label_text">Customer Service Department</option>
                        </select>
              </div>

              <div class="password boxG">
              <label class="form-label label_text">Enter Password</label>
              <input type="password" class="inputBox" placeholder="Password" name="password" required/>  
              </div>

              <div class="cPassword boxG">
              <label class="form-label label_text">Enter Confirm Password</label>
              <input type="password" placeholder="Confirm Password" class="inputBox" name="cpassword" required/>  
              </div>
            <br>
              <button class="submitbtn" type="submit" name="signup">Sign Up</button>
            </div>
       

          </div>
        </div>
</section>
</form>
<form action="" method="post">
&nbsp;&nbsp;
<input type="submit" class="gobackbtn" name="goback" value="Go Back">
</form>
<br>

             <?php
             if(isset($_POST['goback']))
             {
              
            echo "<script>
            location.href = 'loginForm.php';
            </script>";
             }
             ?>
</body>
</html>