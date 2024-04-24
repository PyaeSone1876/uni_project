<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";
    $sql="SELECT year, COUNT(id) AS idea_count
    FROM ideas
    GROUP BY year";
    foreach($conn->query($sql)as $data)
    {
        $year[]=$data['year'];
        $quantity[]=$data['idea_count'];
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
body {
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    font-family: calibri;
    background: white;
}

.card1,
.card2,
.card3,
.card4 {
    width: 23%;
    height: 180px;
    background: white;
    color: black;
    margin-left: 23px;
    margin-bottom: 50px;
    border-radius: 25px;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
    transition: 0.3s;
    cursor: pointer;
}

.cardcontainer {
    display: flex;
    width: 100%;
}

.carddata {
    width: 100%;
    height: 40px;
    margin-top: 50px;
    text-align: center;
    font-size: 20px;
}

.chart {
    background: white;
    border-radius: 10px;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
}

.number_head {}

.chart_head {
    text-align: center;
    margin-bottom: 26px;
    margin: 48px 0px;
}

.number_head {
    text-align: center;
    margin: 50px 0px;
    margin-top: 50px;
    margin-top: 70px;
}


/* iPad Air */

@media (max-width: 820px) {
    .container {
        margin-bottom: 300px;
    }
}

@media (max-width: 1200px) {
    .cardcontainer {
        display: flex;
        width: 100%;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .card1,
    .card2,
    .card3,
    .card4 {
        width: 35%;
    }
}

@media (max-width: 650px) {
    .card1,
    .card2,
    .card3,
    .card4 {
        width: 46%;
    }
}

@media (max-width: 590px) {
    .card1,
    .card2,
    .card3,
    .card4 {
        width: 82%;
    }
}
    </style>
</head>
<body>
<?php $_SESSION["location"]="dashboard
            ";include 'navbar.php' ?>    

<div class="container">
<h1 class="number_head">Quantity of ideas per department</h1>
<div class="cardcontainer">
<div class="card1">
<?php
$sql = "SELECT COUNT(DISTINCT ideas.id) AS ITDept_ideas
FROM ideas
JOIN (
    SELECT id, department FROM admin
    UNION ALL
    SELECT id, department FROM qamanager
    UNION ALL
    SELECT id, department FROM staff
    UNION ALL
    SELECT id, department FROM qacoordinator
) AS users ON ideas.uid = users.id
WHERE users.department = 'IT Department';
";
$strnt = $conn->query($sql);
$fetch = $strnt->fetch();
    ?>
       
        <div class="carddata">
        <strong><span style="color:red">"<?php echo $fetch['ITDept_ideas']?>"</span></strong>
       
        <br><br>
        Quantity of ideas from <br><strong>'IT Department'</strong>
        </div>
</div>

<div class="card2">
<?php
    $sql = "SELECT COUNT(DISTINCT ideas.id) AS StdDept_ideas
    FROM ideas
    JOIN (
        SELECT id, department FROM admin
        UNION ALL
        SELECT id, department FROM qamanager
        UNION ALL
        SELECT id, department FROM staff
        UNION ALL
        SELECT id, department FROM qacoordinator
    ) AS users ON ideas.uid = users.id
    WHERE users.department = 'Student Department';
    ";
      $strnt = $conn->query($sql);
      $fetch = $strnt->fetch();
    ?>
       
        <div class="carddata">
        <strong><span style="color:red">"<?php echo $fetch['StdDept_ideas']?>"</span></strong>
      
        <br><br>
        Quantity of ideas from <br><strong>'Student Department'</strong>
        </div>
</div>

<div class="card3">
<?php
      $sql = "SELECT COUNT(DISTINCT ideas.id) AS CusSerDept_ideas
      FROM ideas
      JOIN (
          SELECT id, department FROM admin
          UNION ALL
          SELECT id, department FROM qamanager
          UNION ALL
          SELECT id, department FROM staff
          UNION ALL
          SELECT id, department FROM qacoordinator
      ) AS users ON ideas.uid = users.id
      WHERE users.department = 'Customer Service Department';
      ";
      $strnt = $conn->query($sql);
      $fetch = $strnt->fetch();
    ?>
       
        <div class="carddata">
        <strong><span style="color:red">"<?php echo $fetch['CusSerDept_ideas']?>"</span></strong>
      
        <br><br>
        Quantity of ideas from <br><strong>'Customer Service Department'</strong>
        </div>
</div>

<div class="card4">
<?php
      $sql = "SELECT COUNT(DISTINCT ideas.id) AS FinanceDept_ideas
      FROM ideas
      JOIN (
          SELECT id, department FROM admin
          UNION ALL
          SELECT id, department FROM qamanager
          UNION ALL
          SELECT id, department FROM staff
          UNION ALL
          SELECT id, department FROM qacoordinator
      ) AS users ON ideas.uid = users.id
      WHERE users.department = 'Finance Department';
      ";
      $strnt = $conn->query($sql);
      $fetch = $strnt->fetch();
    ?>
       
        <div class="carddata">
        <strong><span style="color:red">"<?php echo $fetch['FinanceDept_ideas']?>"</span></strong>
        
        <br><br>
        Quantity of ideas from <br><strong>'Finance Department'</strong>
        </div>
</div>
</div>
<h1 class="chart_head">Quantity of ideas per year</h1>
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
      label: 'Quantity of idea',
      data: <?php echo json_encode($quantity) ?>,
      backgroundColor: 'transparent', // Set background color to transparent for line chart
      borderColor: 'black', // Set border color to black
      pointBackgroundColor: 'red', // Set point color to red
      pointBorderColor: 'transparent', // Set point border color to transparent
      pointRadius: 5, // Set point radius to increase the size of the points
      pointBorderWidth: 0 // Set point border width to 0 to remove the border
    }]
  };

  const config = {
    type: 'line',
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


</div>
<br><br>
      
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
