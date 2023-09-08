<?php
include '../connection/connectionDB.php';

$id = $_GET['id'];

$sql = "select * from students where id='$id'";

$results = $conn->query($sql);
// echo "<br>" . $sql . "<br>";
$results = $conn->query($sql);

// echo "No of rwow is" . $results->rowCount();

if ($results->rowCount() > 0) {
    $row = $results->fetch();
    $name = $row['username'];
    $pass = $row['password'];
    $role = $row['userrole'];

    // echo $name . " " . $pass . " " . $role . "<br>";
}

?>
<html>

<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .table{
            width: 30%;
        }
        .table tr td{
            border: none;
        }
        .col{
            margin-top: 3%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
        <h2>Edit user information</h2>
        <form method="post">
            <table cellpadding=20% class="table">
                <tr>
                    <td>User id</td>
                    <td><input type="text" value="<?php echo $id; ?>" disabled></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><input type="text" value="<?php echo $name; ?>" name="uname"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="text" value="<?php echo $pass; ?>" name="upass"></td>
                </tr>
                <tr>
                    <td>User Role</td>
                    <td>
                        <select name="urole" id="urole" onchange="checkUser()">
                            <option value="<?php echo $role; ?>"> <?php echo $role; ?> </option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Update" name="edit">

        </form>
            </div>
        </div>
    </div>
    <script>
        function checkUser(){
            console.log(document.getElementById('urole').options.length);
            if(document.getElementById('urole').options.length > 2){
                document.getElementById('urole').options[0].remove();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST['edit'])) {
    $n = $_POST['uname'];
    $p = $_POST['upass'];
    $r = $_POST['urole'];
    $upsql = "UPDATE `users` SET `username`='$n',`password`='$p',`userrole`='$r' WHERE id='$id'";
    $conn->exec($upsql);
    header('Location:viewUser.php');
}
?>