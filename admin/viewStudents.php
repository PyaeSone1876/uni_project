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

    $sql = "SELECT * FROM student";
    $results = $conn->query($sql);
    $sname="";
    if(isset($_POST["btnsearch"]))
{
    $sname=$_POST['search'];
    $sql="SELECT * FROM student where username like '%$sname%'";
    $results= $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <style>
    #student-tbl {
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

        #addstudentbutton,#exportbutton
        {
            border-radius:5px;
            margin-left:5px;
            width:5rem;
            height:1.5rem;
            border:none;
            color:white;
            background:black;
        }

        #addstudentbutton:hover,#exportbutton:hover
        {
            cursor:pointer;
            color:black;
            background:white;
        }

        #addstudentbutton
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
        max-width: 240px; 
        white-space: normal;
        word-wrap: break-word;
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

          td
          {
            font-size:12px;
          }

          #edit
        {
            margin-left:10px;
            height:1rem;
            padding:0.25rem 0.5rem 0.25rem 0.5rem;
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
            margin-left:10px;
            height:1rem;
            padding:0.25rem 0.5rem 0.25rem 0.5rem;
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
<?php include 'navbar.php'?>
    <header>
        <h1>Students</h1>
    </header>
    <main>
    <h2>Student Information</h2>
    <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-12">
                <form method="post">
                <div class="input-group">
                        <input type="search" name="search" value="<?php echo $sname; ?>" class="search" placeholder="Search student name ....">

                        <div class="input-group-append">
                            <button class="buttons" type="submit" name="btnsearch" id="buttons">Search</button>
                            <button class="buttons" type="submit" name="btnshowall" id="buttons">Show All</button>
                        </div>
                    </div>
                    <br><br>
                    <div class="input-group">
                            <form method="post">
                            <input id="addstudentbutton" type="submit" name="addstudent" Value="Add Student">
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
    <table class="table table-stripped" id="student-tbl">
        <tr>
            <th>No</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Action</th>
        </tr>
<?php
$serial = 1;
 foreach($conn->query($sql)as $key => $row)
 {
?>       
        <div class="table_value">
        <tr>
        <td class="attributes"><?php echo ++$key;?></td>
        <td class="attributes"><?php echo $row['id'];?></td>
            <td class="attributes"><?php echo $row['username'];?></td>
            <td class="attributes"><?php echo $row['email'];?></td>
            <td class="attributes address-cell"><?php echo $row['address'];?></td>
            <td class="attributes"><?php echo $row['phoneno'];?></td>
            <td class="atrributes" id="actionbtns">
               <a class="btn btn-primary" href="editStudents.php?id=<?php echo $row['id']?>" id="edit">Edit</a>
            </td>
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
    $csvFilePath = '../csvfiles/Student.csv';

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
        location.href = 'viewStudents.php';
        </script>";
}
// Close the CSV file

if (isset($_POST['addstudent'])) {
    echo "
    <script>
    location.href='insertStudent.php';
    </script>";
}
?>