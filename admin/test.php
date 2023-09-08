<?php
if (!isset($_SESSION)) {
    session_start();

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
    <link rel="stylesheet">
    <title>Responsive Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            /* height: 100vh; */
            background-color: #333;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: scroll;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            flex: 1;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
        }

        .chart {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            /* Adjustments for smaller screens, including iPad Air */
            .sidebar {
                width: 100%;
                height: 10000vh;
                /* position: fixed; */
                top: 0;
                left: 0;
                z-index: 1;
                overflow-y: auto;
                background-color: #333;
            }

            .content {
                margin-left: 250px; /* Match the sidebar width */
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <!-- Left Sidebar / Navigation Bar -->
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Dashboard</h1>
        <div class="cards">
        <?php
      $sql1="SELECT count(*) as total_admin from admin";
      $strnt1 = $conn->query($sql1);
      $fetch1 = $strnt1->fetch();
    ?>
    <div class="card"><?php echo $fetch1['total_admin']?>
    <i class="fa-solid fa-screwdriver-wrench box-icon"></i><br><br>
    Administrators
    </div>
    <?php
      $sql2="SELECT count(*) as total_student from student";
      $strnt2 = $conn->query($sql2);
      $fetch2 = $strnt2->fetch();
    ?>
    <div class="card"><?php echo $fetch2['total_student']?>
    <i class="fa-solid fa-screwdriver-wrench box-icon"></i><br><br>
    Students
    </div>

    <?php
      $sql3="SELECT count(*) as total_course from course";
      $strnt3 = $conn->query($sql3);
      $fetch3 = $strnt3->fetch();
    ?>

    <div class="card"><?php echo $fetch3['total_course']?>
    <i class="fa-solid fa-screwdriver-wrench box-icon"></i><br><br>
   Courses
    </div>

    <?php
      $sql4="SELECT count(*) as total_enrollment from enrollment";
      $strnt4 = $conn->query($sql4);
      $fetch4 = $strnt4->fetch();
    ?>

    <div class="card"><?php echo $fetch4['total_enrollment']?>
    <i class="fa-solid fa-screwdriver-wrench box-icon"></i><br><br>
   Enrollements
    </div>
        </div>
        <div class="chart">
            <div>
                <canvas id="myChart" width="800" height="400"></canvas> <!-- Adjust width and height as needed -->
            </div>
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
</body>
</html>
<?php
}
?>