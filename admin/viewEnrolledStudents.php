<?php  
  if(!isset($_SESSION))
  {
      session_start();
  
  }
if (!isset($_SESSION['id'])) {
  header('location:loginform.php');
}
else
{    

include '../connection/connectionDB.php';

$sql = "SELECT 
c.name AS course_name,
c.class AS class_name,
e.id AS enrollment_id,
e.enrollment_date,
s.username AS student_name
FROM 
enrollment e
JOIN 
course c ON e.course_id = c.id
JOIN 
student s ON e.student_id = s.id;
";

$results = $conn->query($sql);
// echo "Record" . $results->rowCount();
$sname="";
if(isset($_POST["btnsearch"]))
{
    $sname=$_POST['search'];
    $sql= "SELECT 
    c.name AS course_name,
    c.class AS class_name,
    e.id AS enrollment_id,
    e.enrollment_date,
    s.username AS student_name
    FROM 
    enrollment e
    JOIN 
    course c ON e.course_id = c.id
    JOIN 
    student s ON e.student_id = s.id where s.username like '%$sname%'";
    $results= $conn->query($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students</title>
    <style>
#enrolledstudent-tbl {
    width: 100%;
    text-align: center;
    
}
    a
    {
        text-decoration:none;
    }
     body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns:20% 80%;
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
            width:100%;
            padding: 10px;
            grid-area: header;
        }

        nav {
            background-color:black;
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
        }

        nav a {
            color:white;
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


        #edit
        {
          
            height:1rem;
            padding:0.5rem 1rem 0.5rem 1rem;
            background-color: black;
            color:white;
            border: none;
            border-radius: 5px;
        }

        #edit:hover {
            background-color: white;
            color:black;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        #delete
        {
            height:1rem;
            padding:0.5rem 0.7rem 0.5rem 0.7rem;
            background-color: black;
            color:white;
            border: none;
            border-radius: 5px;
        }

        #delete:hover {
            background-color: white;
            color:black;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        main {
            padding: 20px;
            grid-area: main;
        }

        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 2px solid black;
        }
    
        table
        {
            width:100%;
        }

        td
        {
            height:100px;
        }

        
        .input-group
        {
            display:flex;
        }

        #makeenrollmentbutton,#exportbutton
        {
            border-radius:5px;
            margin-left:5px;
            width:5rem;
            height:1.5rem;
            border:none;
            color:white;
            background:black;
        }

        #makeenrollmentbutton:hover,#exportbutton:hover
        {
            cursor:pointer;
            color:black;
            background:white;
        }

        #makeenrollmentbutton
        {
            width:115px;
        }


        #buttons
        {
            border-radius:5px;
            margin-left:5px;
            width:5rem;
            height:1.5rem;
            border:none;
            color:white;
            background:black;
        }

        #buttons:hover 
        {
            cursor:pointer;
            color:black;
            background:white;
        }


       #actionbtns
       {
        text-align:center;
       }

       .address-cell {
        max-width: 300px; 
        white-space: normal;
        word-wrap: break-word;
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
<?php include 'navbar.php'?>
    <header>
        <h1>Enrolled Students</h1>
    </header>
    <main>
        <h2>Enrolled Student Information</h2>
    <div class="container">
        <div class="row">
        <div class="row">
            <div class="col-12">
                <form method="post">
                <div class="input-group">
                        <input type="search" name="search" value="<?php echo $sname; ?>" class="search" placeholder="Search user name ....">

                        <div class="input-group-append">
                            <button class="buttons" type="submit" name="btnsearch" id="buttons">Search</button>
                            <button class="buttons" type="submit" name="btnshowall" id="buttons">Show All</button>
                        </div>
                    </div>
                    <br><br>
                    <div class="input-group">
                            <form method="post">
                            <input id="makeenrollmentbutton" type="submit" name="makeenrollment" value="Make Enrollment">
                            </form>
                            <form action="" method="post">
                            <input id="exportbutton" type="submit" name="export" Value="Export">
                            </form>
                    </div>
                    <br>
                </form>
            </div>

        </div>
        </div>
        <div class="row">
        <table class="enrolledstudent-tbl">
        <tr>
            <th>No</th>
            <th>Enrollment ID</th>
            <th>Student Name</th>
            <th>Course Name</th>
            <th>Class Name</th>
            <th>Date</th>
        </tr>
<?php

$serial = 1;
 foreach($conn->query($sql)as $key => $row)
 {
?>       
        <div class="table_value">
        <tr>
            <td class="attributes"><?php echo ++$key;?></td>
            <td class="attributes"><?php echo $row['enrollment_id'];?></td>
            <td class="attributes"><?php echo $row['student_name'];?></td>
            <td class="attributes"><?php echo $row['course_name']?></td>
            <td class="attributes"><?php echo $row['class_name']?></td>
            <td class="attributes"><?php echo $row['enrollment_date'];?></td>
        </tr>
        </div>
        <?php
 }
        ?>

    </table>
        </div>
    </div>
    </main>
 
</body>

</html>
<?php
}

if (isset($_POST['export'])) {
    echo "exporting";

    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // CSV file path
    $csvFilePath = '../csvfiles/Enrolled_Student.csv';

    // Open the CSV file for writing
    $csvFile = fopen($csvFilePath, 'w');

    // Write the column headers to the CSV file
    fputcsv($csvFile, array_keys($data[0]));
    if ($csvFile === false) {
        die("Failed to open CSV file for writing.");
    }

    // Write data rows to the CSV file
    foreach ($data as $row) {
        fputcsv($csvFile, $row);
    }
    fclose($csvFile);


    echo "<script>
        alert('CSV file has been successfully exported.');
        location.href = '../admin/viewEnrolledStudents.php';
        </script>";
}
// Close the CSV file


if (isset($_POST['makeenrollment'])) {
    echo "
    <script>
    location.href='enrollmentForm.php';
    </script>";
}
?>
