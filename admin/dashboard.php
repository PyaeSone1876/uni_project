
<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginform.php');
} else {
    include '../connection/connectionDB.php';
$sql="SELECT enrollment_year, COUNT(id) AS enrollment_count
FROM enrollment
GROUP BY enrollment_year";
 foreach($conn->query($sql)as $data)
 {
    $year[]=$data['enrollment_year'];
    $quantity[]=$data['enrollment_count'];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   
    <style>
      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: 20% 80%;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "nav header"
                "nav main"
                "nav footer";
            min-height: 100vh;
            background:wheat;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            grid-area: header;
        }

        .icon
        {
            color:black;
        }

        .username
        {
            padding:5px 10px 5px 10px;
            float:right;
            background:white;
            border-radius:50px;

        }

        .card1,.card2,.card3,.card4
        {
            width:25%;
            height:150px;
            background:white;
            color:black;
            margin-left:5px;
            margin-bottom:50px;
            border-radius:25px;

            
        }

        .cardcontainer
        {
            display:flex;
            width:100%;
            
        }

        .carddata
        {
            width:100%;
            height:40px;
            text-align:center;
            margin-top:50px;
            font-size:20px;
        }

        .text
        {
            margin-left:5px;
        }

        nav {
            background-color: black;
            padding: 10px;
            grid-area: nav;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        nav a:hover {
            color: black;
            background-color: white;
        }

        nav li {
            margin: 5px 0;
        }

        main {
            padding: 20px;
            grid-area: main;
            font-size: 16px; /* Default font size */
        }
        
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            grid-area: footer;
        }

        .chart
        {
            background:white;
            border-radius:10px;
        }

       
 /* iPad Air */
 @media (max-width:821px)  
{
    header
    {
        margin-left:5px;
    }
   nav li a
   {
    font-size:15px;
    margin-bottom:100px;
   }

   nav li 
   {
    margin-top:10px;
   }
   
   nav 
   {
    width:150px;
   }

  
}

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
   
    <main>
    <div class="username"><i class="fa-solid fa-user icon"></i><span class="text"><?php echo $_SESSION["username"]?></span></div>
    <br><br>
        <h2>Welcome to the Admin Dashboard</h2>
<div class="cardcontainer">
<?php
      $sql1="SELECT count(*) as total_admin from admin";
      $strnt1 = $conn->query($sql1);
      $fetch1 = $strnt1->fetch();
    ?>
        <div class="card1">
        <div class="carddata">
        <?php echo $fetch1['total_admin']?>
        <i class="fa-solid fa-screwdriver-wrench box-icon"></i>
        <br><br>
        Administrators
        </div>
        </div>

        <?php
      $sql2="SELECT count(*) as total_student from student";
      $strnt2 = $conn->query($sql2);
      $fetch2 = $strnt2->fetch();
    ?>
        <div class="card2">
        <div class="carddata">
        <?php echo $fetch2['total_student']?>
        <i class="fa-solid fa-user"></i>
        <br><br>
        Students
        </div>
        </div>

        <?php
      $sql3="SELECT count(*) as total_course from course";
      $strnt3 = $conn->query($sql3);
      $fetch3 = $strnt3->fetch();
    ?>
        <div class="card3">
        <div class="carddata">
        <?php echo $fetch3['total_course']?>
        <i class="fa-solid fa-book"></i>
        <br><br>
        Courses
        </div>
        </div>

        <?php
      $sql4="SELECT count(*) as total_enrollment from enrollment";
      $strnt4 = $conn->query($sql4);
      $fetch4 = $strnt4->fetch();
    ?>
        <div class="card4">
        <div class="carddata">
        <?php echo $fetch4['total_enrollment']?>
        <i class="fa-solid fa-rectangle-list"></i>
        <br><br>
        Enrollments
        </div>
        </div>
        

</div>

<h2>Yealry Enrollment Bar Chart</h2>
        <div class="chart">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
  const labels = <?php echo json_encode($year) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Quantity of enrollment',
      data: <?php echo json_encode($quantity) ?>,
      backgroundColor: ['skyblue'],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
    </main>
</body>
</html>
<?php
}
?>
