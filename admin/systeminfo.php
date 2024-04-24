<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
    include "../connection/connectionDB.php";

            $sql = "SELECT * FROM admin";
            $results = $conn->query($sql);
            
            $sql1= "SELECT * FROM qamanager";
            $results1 = $conn->query($sql1);


            $sql2 = "SELECT * FROM qacoordinator";
            $results2 = $conn->query($sql2);


            $sql3 = "SELECT * FROM ideas";
            $results3 = $conn->query($sql3);

            $sql4 = "SELECT * FROM comments";
            $results4 = $conn->query($sql4);


            $sql5 = "SELECT * FROM staff";
            $results5 = $conn->query($sql5);

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
    background: rgb(255, 255, 255);
    font-family: "calibri";
}

.container {
    min-height: 626px;
}

.section {
    /* background-color: green; */
    width: 291px;
    height: 43px;
    box-sizing: border-box;
    padding-left: 6px;
    padding-top: 8px;
    margin-top: 23px;
    margin-left: 4%;
    position: relative;
    z-index: 5;
}

thead {
    /* box-shadow: 0 5px 10px rgba(82, 82, 82, 0.2); */
    border-radius: 5px;
    color: #0a4ba7;
}

#selectTable {
    background-color: white;
    border: 1px solid black;
    height: 29px;
    width: 146px;
    border-radius: 5px;
    padding: 5px;
    margin-left: 20px;
}

.tableContainer {
    /* margin: auto; */
    width: 100%;
    /* background-color: rgba(0, 0, 0, 0.1); */
}

.table {
    border-collapse: collapse;
    /* background: rgba(0, 0, 0, 0.1); */
}

th {
    height: 60px;
    /* background: rgba(0, 0, 0, 0.2); */
    font-size: 18px;
}

tr:nth-child(even) {
    background: rgba(135, 171, 189, 0.2);
}

tbody {}

.division {
    background: white;
    height: auto;
    width: 66%;
    margin: auto;
    margin-bottom: auto;
    margin-bottom: 45px;
    border-radius: 10px;
    box-shadow: 0px 0px 25px rgba(211, 211, 211, 0.9);
}

.division h1 {
    padding: 12px;
    border-radius: 10px 10px 0px 0px;
    text-align: center;
    margin-bottom: 0;
    border-bottom: 1px solid rgba(148, 148, 148, 0.5);
    width: 95%;
    text-align: center;
    margin-left: 1.5%;
    color: #0a4ba7;
}

.tableRow {}


/* td {
    height: 63px;
} */


/* /////////////// */

body {
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    /* background: white; */
}

a {
    text-decoration: none;
}

#edit {
    height: 1rem;
    padding: 0.5rem 1rem 0.5rem 1rem;
    background-color: #0a4ba7;
    color: white;
    border: none;
    border-radius: 5px;
    transition: 0.2s;
    position: relative;
    z-index: 5;
}

#edit:hover {
    background-color: white;
    color: black;
    border: none;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

th {
    min-width: 30px;
}

#staff-tbl,
#qa-tbl,
#qaco-tbl,
#admin-tbl,
#ideas-tbl,
#comments-tbl {
    width: 100%;
    text-align: center;
    border-collapse: collapse;
    border-radius: 10px;
}

#staff-tbl,
th,
td {
    /* border: 2px solid black; */
}

td {
    height: 60px;
    color: rgb(60, 60, 60)
}

.selectBtn {
    position: absolute;
    top: 227px;
    left: 26.4%;
    width: 115px;
    height: 32px;
    border: 1px solid #4870A6;
    border-radius: 5px;
    background: white;
    color: #1F69CC;
    cursor: pointer;
    font-weight: bold;
    text-transform: capitalize;
    transition: 0.3s;
}

.selectBtn:hover {
    color: white;
    background-color: #4870A6;
}

@media screen and (max-width: 1206px) {
    .division {
        width: 90%;
    }
}

@media screen and (max-width: 912px) {
    .division {
        font-size: 14px;
        width: 83%;
    }
    th {
        height: 60px;
        font-size: 16px;
    }
}

@media screen and (max-width: 800px) {
    .division {
        font-size: 14px;
        width: 100%;
    }
    th {
        height: 60px;
        font-size: 16px;
    }
}

@media screen and (max-width: 700px) {
    .division {
        font-size: 14px;
        width: 100%;
    }
    th {
        height: 60px;
        font-size: 16px;
    }
}

@media screen and (max-width: 600px) {
    .division h1 {
        padding: 12px;
        border-radius: 10px 10px 0px 0px;
        text-align: center;
        margin-bottom: 0;
        border-bottom: 1px solid rgba(148, 148, 148, 0.5);
        width: 95%;
        text-align: center;
        margin-left: 1.5%;
        color: #0a4ba7;
        font-size: 16px;
    }
    .selectBtn {
        position: absolute;
        top: 23.3%;
        left: 11.7%;
        width: 87px;
        height: 29px;
        border: 1px solid #4870A6;
        border-radius: 5px;
        background: white;
        background-color: white;
        color: #1F69CC;
        cursor: pointer;
        font-weight: bold;
        text-transform: capitalize;
        transition: 0.3s;
        font-size: 10px;
    }
    .division h1 {
        padding: 12px;
        border-radius: 10px 10px 0px 0px;
        text-align: center;
        margin-bottom: 0;
        border-bottom: 1px solid rgba(148, 148, 148, 0.5);
        width: 95%;
        text-align: center;
        margin-left: 1.5%;
        color: #0a4ba7;
        font-size: 16px;
    }
    th {
        height: 36px;
        font-size: 11px;
    }
    td {
        height: 27px;
        color: rgb(60, 60, 60);
    }
    table {
        font-size: 10px;
    }
}

@media screen and (max-width: 600px) {
    td {
        height: 27px;
        color: rgb(60, 60, 60);
        max-width: 27px;
        font-size: 8px;
        white-space: normal;
    }
    th {
        height: 36px;
        font-size: 8px;
        max-width: 30px;
        padding: 0px;
        overflow: hidden;
    }
    table {
        font-size: 8px;
    }
    thead {
        border-radius: 5px;
        color: #0a4ba7;
    }
}

    </style>
</head>
<body>
<?php $_SESSION["location"]="systemInfo"; include 'navbar.php' ?>    

<div class="container">
<form action="" method="GET" class="section">
        <label for="choose table">Choose Table:</label>
        <select name="table" id="selectTable">
            <option value="admin">Admin</option>
            <option value="qamanager">QA Manager</option>
            <option value="qacoordinator">QA Coordinator</option>
            <option value="staff">Staff</option>
            <option value="ideas">Ideas</option>
            <option value="comments">Comments</option>
        </select>
    </form>

     <!-- Admin -->
     <div class="division" id="admin">
     <button id="export-btn" class="selectBtn">Export to CSV</button>
     <h1>Admin</h1>


    <script>
    document.getElementById('export-btn').addEventListener('click', function() {
        var table = document.getElementById('admin-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'admin_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>
<!-- admin table -->
<div class="tableContainer">

    <table id="admin-tbl" class="table">
        <thead>
        <tr class="tableHeader">
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Password</th>
            <th>Department</th>
        </tr>
        </thead>
<?php
$serial = 1;
 foreach($results as $key => $row)
 {
?>       
        <tr class="">
        <td class="attributes tableRow"><?php echo ++$key;?></td>
        <td class="attributes"><?php echo $row['id'];?></td>
            <td class="attributes"><?php echo $row['username'];?></td>
            <td class="attributes"><?php echo $row['email'];?></td>
            <td class="attributes"><?php echo $row['address'];?></td>
            <td class="attributes"><?php echo $row['password'];?></td>
            <td class="attributes"><?php echo $row['department'];?></td>
        </tr>
        <?php
 }
        ?>

    </table>
    </div>
   </div>

    <!-- QA Manager -->
   <div class="division" id="qamanager">
   <button id="export-qa-btn" class="selectBtn">Export to CSV</button>
   <h1> QA Manager </h1>
    

    <script>
    document.getElementById('export-qa-btn').addEventListener('click', function() {
        var table = document.getElementById('qa-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'qamanager_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>

    <table id="qa-tbl" class="table">
    <thead>
        <tr class="tableHeader">
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Password</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
<?php
$serial = 1;
 foreach($results1 as $key => $row)
 {
?>       
        <tr>
        <td class="attributes"><?php echo ++$key;?></td>
        <td class="attributes"><?php echo $row['id'];?></td>
            <td class="attributes"><?php echo $row['username'];?></td>
            <td class="attributes"><?php echo $row['email'];?></td>
            <td class="attributes"><?php echo $row['address'];?></td>
            <td class="attributes"><?php echo $row['password'];?></td>
            <td class="attributes"><?php echo $row['department'];?></td>
        </tr>
        <?php
 }
        ?>
</tbody>
    </table>
   </div>
        <!-- QA Coordinator -->
        <div class="division" id="qacoordinator">
        <h1> QA Coordinator </h1>
        <button id="export-qacoordinator-btn" class="selectBtn">Export to CSV</button>
        <script>
    document.getElementById('export-qacoordinator-btn').addEventListener('click', function() {
        var table = document.getElementById('qaco-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'qacoordinator_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>

        <table id="qaco-tbl" class="table">
        <thead>
        <tr class="tableHeader">
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Password</th>
            <th>Department</th>
        </tr>
        </thead>
        <tbody>
<?php
$serial = 1;
 foreach($results2 as $key => $row)
 {
?>       
        <tr>
        <td class="attributes"><?php echo ++$key;?></td>
        <td class="attributes"><?php echo $row['id'];?></td>
            <td class="attributes"><?php echo $row['username'];?></td>
            <td class="attributes"><?php echo $row['email'];?></td>
            <td class="attributes"><?php echo $row['address'];?></td>
            <td class="attributes"><?php echo $row['password'];?></td>
            <td class="attributes"><?php echo $row['department'];?></td>
        </tr>
        <?php
 }
        ?>
    </tbody>
    </table>
    </div>
    <!-- Staff -->
    <div class="division" id="staff">
    <h1> Staff </h1>
    <button id="export-staff-btn" class="selectBtn">Export to CSV</button>

    <script>
    document.getElementById('export-staff-btn').addEventListener('click', function() {
        var table = document.getElementById('staff-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length - 1; j++) { // Exclude the last column (action column)
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'staff_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>

    <table id="staff-tbl" class="table">
        <thead>
        <tr class="tableHeader">
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Password</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
<?php
$serial = 1;
 foreach($results5 as $key => $row)
 {
?>       
        <tr>
        <td class="attributes"><?php echo ++$key;?></td>
        <td class="attributes"><?php echo $row['id'];?></td>
            <td class="attributes"><?php echo $row['username'];?></td>
            <td class="attributes"><?php echo $row['email'];?></td>
            <td class="attributes"><?php echo $row['address'];?></td>
            <td class="attributes"><?php echo $row['password'];?></td>
            <td class="attributes"><?php echo $row['department'];?></td>
                <td class="atrributes" id="actionbtns">
                    <a class="btn btn-primary" href="editstaff.php?id=<?php echo $row['id']?>" id="edit">Edit</a>
                </td>
        </tr>
        <?php
 }
        ?>
    </tbody>
    </table>
    </div>
        <!-- Idea -->
       <div class="division" id="ideas">
       <h1> Ideas </h1>
    <button id="export-ideas-btn" class="selectBtn">Export to CSV</button>

<script>
    document.getElementById('export-ideas-btn').addEventListener('click', function() {
        var table = document.getElementById('ideas-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'ideas_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>
        <table id="ideas-tbl" class="table">
            <thead>
            <tr class="tableHeader">
                <th>No</th>
                <th>Post ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Content</th>
                <th>Like Count</th>
                <th>Unlike Count</th>
                <th>Comment Count</th>
                <th>Views</th>
                <th>Category</th>
                <th>Date Created</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results3 as $key => $row) 
            { 
            ?>
                <tr>
                    <td class="attributes"><?php echo ++$key; ?></td>
                    <td class="attributes"><?php echo $row['id']; ?></td>
                    <td class="attributes"><?php echo $row['uid']; ?></td>
                    <td class="attributes"><?php echo $row['username']; ?></td>
                    <td class="attributes"><?php echo $row['content']; ?></td>
                    <td class="attributes"><?php echo $row['like_count']; ?></td>
                    <td class="attributes"><?php echo $row['unlike_count']; ?></td>
                    <td class="attributes"><?php echo $row['comment_count']; ?></td>
                    <td class="attributes"><?php echo $row['views']; ?></td>
                    <td class="attributes"><?php echo $row['category']; ?></td>
                    <td class="attributes"><?php echo $row['date_created']; ?></td>
                </tr>
            <?php 
            } 
            ?>
            </tbody>
        </table>
       </div>
        <!-- Comment -->
       <div class="division" id="comments">
       <h1> Comments </h1>
        <button id="export-comments-btn" class="selectBtn">Export to CSV</button>

<!-- JavaScript for Exporting to CSV -->
<script>
    document.getElementById('export-comments-btn').addEventListener('click', function() {
        var table = document.getElementById('comments-tbl');
        var rows = table.querySelectorAll('tr');
        var csv = [];

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                // Properly quote cell values and escape existing quotes
                var cellValue = cols[j].innerText.replace(/"/g, '""');
                row.push('"' + cellValue + '"');
            }
            csv.push(row.join(','));
        }

        var csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'comments_data.csv');
        document.body.appendChild(link);
        link.click();
    });
</script>
        <table id="comments-tbl" class="table">
            <thead>
            <tr class="tableHeader">
                <th>No</th>
                <th>Post ID</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Comment</th>
                <th>Like Count</th>
                <th>Unlike Count</th>
                <th>Date Ment</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results4 as $key => $row) 
            {
            ?>
                <tr>
                    <td class="attributes"><?php echo ++$key; ?></td>
                    <td class="attributes"><?php echo $row['id']; ?></td>
                    <td class="attributes"><?php echo $row['uid']; ?></td>
                    <td class="attributes"><?php echo $row['username']; ?></td>
                    <td class="attributes"><?php echo $row['comments']; ?></td>
                    <td class="attributes"><?php echo $row['like_count']; ?></td>
                    <td class="attributes"><?php echo $row['unlike_count']; ?></td>
                    <td class="attributes"><?php echo $row['date_ment']; ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
       </div>
   
</div>

<?php include 'footer.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectTable = document.getElementById('selectTable');
        var divisions = document.querySelectorAll('.division');

        selectTable.addEventListener('change', function() {
            var selectedOption = selectTable.value;
            divisions.forEach(function(division) {
                if (division.id === selectedOption) {
                    division.style.display = 'block';
                } else {
                    division.style.display = 'none';
                }
            });
        });
        
        // Initially, display the default selected table and hide others
        var defaultOption = selectTable.value;
        divisions.forEach(function(division) {
            if (division.id === defaultOption) {
                division.style.display = 'block';
            } else {
                division.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
<?php
}
?>