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
            margin-left: 31px;
            transition: 0.2s;
            position: absolute;
            top: 52px;
        }

        nav
        {
            padding-top: 15px;     
        }

        .nav-links a {
           text-decoration: none;
           color: white;

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
        left: 233px;
       }

       .navlogo:hover
   {
       cursor:pointer;
       background:none;
   }
   .text{
    color:white;
   }

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

       .navbar
       {
        border-radius: 10px;
        background-color: #0B2A54;
        height: 118px;
        box-sizing: border-box;
    
       }
   /* iPad Air */


   @media (max-width:820px)  
{
    .nav-links
   {
    width:780px;
   }

   .nav-links li 
   {
    width:150px;
   }

   .nav-links li a
   {
    font-size:15px;
   }

   .navbar
   {
    width: 100%;
   }
   .text{
    color:white;
   }

}

@media screen and (max-width: 463px) { 

    .btnLink{
        margin-left:13px;
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
            <div class="bitems"><a href="homepage.php" class="navlogo"><i class="fa-brands fa-phoenix-framework logo"></i></a><p class="brand">University System</p></div>
            <li><a href="feed.php" class="btnLink"

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
                 <a class="nav-link" href="loginForm.php">Login</a>
             </li>
         <?php
            } 
            else 
             {
            ?>

             <li class="nav-item">
                 <a class="nav-link btnLink logoutBtn" href="logout.php" >Log out</a>      
             </li>
             <div class="username"><i class="fa-solid fa-user userIconNav" ></i> <span class="text"><?php echo $_SESSION["username"]?></span></div>
         <?php
            }
            ?>
        </ul>
</nav>
