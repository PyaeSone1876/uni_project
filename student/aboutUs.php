<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['id'])) {
    header('location: loginForm.php');
    exit();
} else {
        include "../connection/connectionDB.php";
        $id=$_SESSION['id'];
        $sql ="select * from student where id='$id'";
        $sql1 ="select * from course";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>


body
{
    background: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);
    background-repeat:no-repeat;
    background-attachment:fixed;
    background-size:100% 100%;
}

.contactform{
       padding:5rem;
       width:24.5rem;
       margin:0 auto;
       background:black;
       color:white;
       align-items:center;
       box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
       border-radius:25px;
       
    }

    textarea
    {
        resize: none;
    }

   .contentitems
    {
        text-align:center;
    }

    form input[type="text"]
    {
        width:240px;
    }

    form input[type="email"]
    {
        width:240px;
    }

    .btnsend
    {
        background:white;
        color:black;
        border:none;
        border-radius:5px;
        padding:5px 10px 5px 10px;
    }

    .btnsend:hover
    {
        background:grey;
    }
    .text
       {
           text-align:center;
       }

       .title
       {
        text-align:center;
       }



    </style>
</head>
<body>
<?php include 'navbar.php' ?>
<div class="container">
<div class="title"><h1>Welcome to Phoenix Private English School</h1></div>
<br><br>
<div class="text">At Phoenix Private English School, we are dedicated to igniting the flames of knowledge and fostering a lifelong love for the English language. Established with a vision to empower individuals with the ability to communicate effectively, our school stands as a beacon of excellence in English education.</div>
<br><br>
<div class="title"><strong>Our Story:</strong></div>
<br><br>
<div class="text">Phoenix Private English School was founded with a burning passion for education and language. Like the mythical bird rising from its own ashes, we believe in the power of transformation through learning. Our journey began with a handful of educators who recognized the need for a comprehensive, personalized approach to English language education. Over the years, we have grown into a thriving community of learners, instructors, and supporters who share a common goal: to enable every student to spread their wings and reach new heights through language proficiency.</div>
<br><br>
<div class="title"><strong>Our Mission:</strong></div>
<br><br>
<div class="text">At Phoenix, our mission is to provide an exceptional learning environment that nurtures each student's language skills, critical thinking abilities, and cultural awareness. We understand that language is more than just words; it's a gateway to opportunities, connections, and understanding. Our dedicated team of educators is committed to guiding students on their language learning journey, helping them become confident communicators who can thrive in an interconnected world.</div>
<br><br>
<div class="title"><strong>What Sets Us Apart:</strong></div>

<br><br>
<div class="title"><strong>1. Holistic Learning: </strong></div>
<br><br>
<div class="text">We believe in a well-rounded education. Our curriculum goes beyond grammar and vocabulary, encompassing literature, cultural studies, and practical language usage.</div>
<br><br>
<div class="title"><strong>2. Expert Educators:</strong> </div>
<br><br>
<div class="text">Our teachers are experienced, qualified, and passionate about teaching. They create an engaging and interactive learning environment where every student's unique strengths are recognized and celebrated.</div>
<br><br>
<div class="title"><strong>3. Personalized Approach:</strong> </div>
<br><br>
<div class="text">We understand that every student is different. Our small class sizes allow us to tailor our teaching methods to the individual needs and learning styles of our students.</div>
<br><br>
<div class="title"><strong>4. State-of-the-Art Facilities:</strong> </div>
<br><br>
<div class="text">Our school is equipped with modern classrooms, multimedia resources, and a well-stocked library to enhance the learning experience.</div>
<br><br>
<div class="title"><strong>5. Engaging Activities:</strong> </div>
<br><br>
<div class="text">From debates and drama to language clubs and creative writing workshops, we offer a range of extracurricular activities that make language learning exciting and dynamic.</div>
<br><br>
<div class="title"><strong>6. Cultural Sensitivity: </strong></div>
<br><br>
<div class="text">English is a global language, and we emphasize understanding and appreciating different cultures and perspectives as an integral part of language learning.</div>
<br><br>
<div class="title"><strong>7. Community and Support: </strong></div>
<br><br>
<div class="text">Joining Phoenix means becoming a part of a supportive and inclusive community. We organize events, seminars, and parent-teacher conferences to keep everyone involved and informed.</div>
<br><br>
<div class="title"><strong>Join Us:</strong></div>
<br><br>
<div class="text">Whether you're a young learner taking your first steps in English or an adult aiming to enhance your language skills, Phoenix Private English School welcomes you with open arms. Come be a part of our journey as we rise together, empowered by language, knowledge, and the spirit of the phoenix.</div>
<br><br>
<div class="text">Together, let's soar to new linguistic horizons at Phoenix Private English School.</div>
<br><br>
</div>
<br><br>
    <?php include 'footer.php' ?>
</body>
</html>
<?php
}
?>
