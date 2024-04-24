<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="test.css"> -->
</head>
<!-- variable place -->
<?php
// session_start();    
if(isset($_SESSION['al_msg']))
{
    $header=$_SESSION['al_msg']['header'];
    $body=$_SESSION['al_msg']['body'];
}else{
    $header="Error Msg";
    $body="Msg Body";
}

?>

<style>

    .al_bg {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    position: fixed;
    font-family: "calibri";
    display: none;
    z-index: 5;
}

.al_box {
    background: white;
    width: 25%;
    margin: auto;
    margin-top: auto;
    margin-top: 300px;
    box-sizing: border-box;
    height: 20%;
    padding: 23px;
    border-radius: 13px;
    position: relative;
}

h1 {
    margin-top: 0px;
    font-size: 24px;
}

label {}

.al_btn {
    width: 60px;
    height: 60px;
    position: absolute;
    top: 139px;
    left: 91%;
    border-radius: 50%;
    border: 0px;
    color: white;
    background: #387aed;
    text-transform: uppercase;
    transition: 0.2s;
    cursor: pointer;
}

.al_btn:hover {
    color: white;
    background: #258eeb;
    /* border: 1px solid #256eeb; */
}

@media (max-width: 1200px) {
    .al_box{
        width: 38%;
    }
}

@media (max-width: 800px) {
    .al_box{
        width: 50%;
    }
}


@media (max-width: 500px) {
    .al_box{
        width: 75%;
    }
}

<?php if(isset($_SESSION['al_msg'])) {
    ?>
    .al_bg{
        display: block;
    }
    <?php }?>
</style>

<body>
    <div class="al_bg">
        <div class="al_box">
            <h1>
               <?php echo $header;?>
            </h1>
            <label for="">
            <?php echo $body;?>
            </label>
            <button class="al_btn">Ok</button>
        </div>
    </div>
</body>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the button element
            var okButton = document.querySelector('.al_btn');

            // Add click event listener to the button
            okButton.addEventListener('click', function() {
                // Get the alert box element
                var alertBox = document.querySelector('.al_bg');

                // Hide the alert box by setting its display to 'none'
                alertBox.style.display = 'none';
                <?php unset($_SESSION['al_msg']); ?>
            });
        });
    </script>
</html>