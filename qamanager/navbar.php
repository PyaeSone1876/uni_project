<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>    

.logo
    {
        font-size:25px;
        color:red;
    }

    .brand
    {
        font-size:15px;
        color:red;
        font-family:"Times New Roman";
    }

    .bitems
    {
        text-align:center;
    }

    .nav-links {
        list-style: none;
         display: flex;
         gap: 2px;
         
        }

        .btnLink{
            border-radius: 5px;
            margin-left: 15px;
            transition: 0.2s;
            position: absolute;
            top: 52px;
            /* background: green; */
        }

        nav
        {
            padding-top: 15px;     
        }

        .nav-links a {
           text-decoration: none;
           /* color: white; */

        }

       nav li
       {
        margin-top:10px;
       }

       nav a {
            color:white;
            text-decoration: none;
            padding: 5px 10px;
       } 

       .userIconNav {
            display: inline-block;
            background: white;
            color: #11468F;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            text-align: center;
            box-sizing: border-box;
            padding: 7px;
            margin-right: 11px;
            font-size: 19px;
            margin: 0px;
            margin-bottom: 10px;
        }

        nav a:hover {
            color: black;
            background-color: white;
            border-radius:5px;
       }

       .logoutBtn{
        left: 686px;
       }

       .navlogo:hover
   {
       cursor:pointer;
       background:none;
   }
   .text{
    color:white;
   }

   .dropDown{
    background: rgba(0,0,0,0.3);
    width: 286px;
    height: 0px;
    position: absolute;
    top: 51px;
    right: 0px;
    text-align: center;
    border-radius: 10px;
    overflow: hidden;
    z-index: 3;
}


   .LinkingBtn{
    /* background: orange; */
    width: 213px;
    display: inline-block;
    height: 26px;
    padding-top: 8px;
    border-radius: 77px;
    transition: 0.2s;
   }

   .LinkingBtn:hover{
    color:#0B2A54;
    border-radius: 30px;
   }

   <?php if($_SESSION["location"]=="manageCat"){?>
    .manageCatD{
        background:white;
        color:#0B2A54;
    }
   <?php }?>

   <?php if($_SESSION["location"]=="feed"){ ?>
    .feedD{
        background:white;
        color:#0B2A54;
    }
   <?php }?>

   .dshD{}

   .mcdD{}

   .sysInfoD{}

   .feedD{}

   .logOutD{}

   .username{
    color: white;
    height: 75px;
    box-sizing: border-box;
    padding-top: 11px;
    position: absolute;
    right: 71px;
    width: 74px;
    align-content: center;
    align-items: center;
    text-align: center;
    top: 25px;
   }

   .dropDownBar{
    right: 0px;
    position: absolute;
    color: white;
    font-size: 38px;
    top: 5px;
    cursor: pointer;
    display: none;
   }

   .dropdownAll{
    /* background: green; */
    width: 297px;
    height: 334px;
    position: absolute;
    right: 144px;
    display: none;
   }

   .cross{
    left: 78%;
    position: absolute;
    color: white;
    font-size: 38px;
    top: 48px;
    cursor: pointer;
    display: none;
   }

   .dashBtn{}

    .mcdBtn{
        left: 269px;
    }

    .systemInfoBtn{
        left: 447px;
    }

    .feedBtn {
        left: 308px;
    }

    .logoutBtn {
        left: 370px;
    }

       .navbar
       {
        border-radius: 10px;
        background-color: #0B2A54;
        height: 118px;
        box-sizing: border-box;
        font-family: "calibri";
       }

       /* @media (min-width: 912px) {
    .dropDownBar,
    .cross {
        display: none;
    }

    .dropDown{
        height: 0px;
    }
} */

@media (max-width: 911px) {
    .dropDownBar {
        display: block;
    }

    .dropdownAll{
        display: block;
    }


   .btnLink,
    .cross {
        display: none;
    }

}
       
   /* iPad Air */
   @media (max-width:820px)  
{
    .nav-links
   {
    width:780px;
   }

   /* .nav-links li 
   {
    width:150px;
   } */

   /* .nav-links li a
   {
    font-size:15px;
   } */

   .navbar
   {
    width: 100%;
   }
   .text{
    color: white;
    display: block;
   }

}

@media screen and (max-width: 522px) { 

    .dropdownAll{
        width: 297px;
        height: 334px;
        position: absolute;
        left: 162px;
    }
    .dropDownBar{
        left: 10px;
    }

    .dropDown{
        right: 5px;
    }
}

@media screen and (max-width: 463px) { 

    .btnLink{
        margin-left:13px;
    }

    .dropdownAll{
        left: 47px;
    }

    .dropDownBar {
    left: 137px;
  }
}

@media screen and (max-width: 437px) { 

.username{
    right:33px;
    }

    .nav-links{
        margin-left: 7px;
    }

    .logoutBtn{
        left: 200px;
    }

    .nav-links{
        padding-left: 7px;
    }

    .userIconNav{
        width:33px;
        height:33px;
    }

    .username{
        font-size: 12px;
        right: 9px;
    }
}

</style>
<nav class="navbar">
        <ul class="nav-links">
            <div class="bitems"><a href="homepage.php" class="navlogo"><i class="fa-brands fa-phoenix-framework logo"></i></a><p class="brand" class="btnLink">University System</p></div>

            <li><a href="managecategory.php" class="btnLink dashBtn"

            <?php if($_SESSION['location']=="manageCat"){?>
                style="background:white;color:#0B2A54;";
            <?php
                }?>
            
            >Manage Category</a></li>


            <li><a href="feed.php" class="btnLink feedBtn" 

            <?php if($_SESSION["location"]=="feed"){?>
                style="background:white;color:#0B2A54;";

            <?php
                }?>
            
            >Feed</a></li>

            <?php
            if (!isset($_SESSION['id'])) 
            
            {

            ?>
             <li class="nav-item">
                 <a class="nav-link btnLink logoutBtn" href="loginForm.php">Login</a>
             </li>
         <?php
            } 
            else 
             {
            ?>

             <li class="nav-item">
                 <a class="nav-link btnLink logoutBtn"  href="logout.php">Log out</a>      
             </li>

             <div class="dropdownAll">
             <div class="dropDownBar" id="dropDownBar"><i class="fa-solid fa-bars"></i></div>

             <div class="dropDown" id="dropDown" style="height:0px;">
                    <li><a href="managecategory.php" class="LinkingBtn manageCatD">Manage Category</a></li>
                    <li><a href="feed.php" class="LinkingBtn feedD">Feed</a></li>
                    <li><a href="../useroptions/userOptions.php" class="LinkingBtn logOutD">Log Out</a></li>
             </div>
             </div>
             <div class="username"><i class="fa-solid fa-user userIconNav"></i> <span class="text"><?php echo $_SESSION["username"]?></span></div>


         <?php
            }
            ?>
        </ul>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get references to the dropdown bar, dropdown content, and the cross icon
        const dropDownBar = document.getElementById('dropDownBar');
        const dropDown = document.getElementById('dropDown');
        const cross = document.getElementById('cross');

        // Function to show the dropdown content and change the class of the dropdown bar icon
        function showDropDown() {
            dropDown.style.height = '158px';
            dropDownBar.firstElementChild.classList.remove('fa-bars');
            dropDownBar.firstElementChild.classList.add('fa-xmark');
            dropDown.style.zIndex='6';
        }

        // Function to hide the dropdown content and change the class of the dropdown bar icon
        function hideDropDown() {
            dropDown.style.height = '0px';
            dropDownBar.firstElementChild.classList.remove('fa-xmark');
            dropDownBar.firstElementChild.classList.add('fa-bars');
            dropDown.style.zIndex='0';
        }

        // Toggle dropdown content and dropdown bar icon class on dropdown bar click
        dropDownBar.addEventListener('click', function () {
            if (dropDown.style.height == '0px') {
                showDropDown();
            } else {
                hideDropDown();
            }
        });
        
// Update height of dropdown content when window is resized
window.addEventListener('resize', function () {
    if (window.innerWidth > 912) {
        dropDown.style.height = '0px';
        // dropDown.style.background = "green";
        dropDownBar.firstElementChild.classList.remove('fa-xmark');
        dropDownBar.firstElementChild.classList.add('fa-bars');
    } else {
        // dropDown.style.background = "blue";
    }
});
    });
</script>


