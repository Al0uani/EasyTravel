<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding -->
    <meta charset="UTF-8">
    
    <!-- Browser compatibility -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage -->
    <title>EasyTravel</title>
<!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

     <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    

    <!-- Custom stylesheets -->
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/service.css">
    <link rel="stylesheet" href="../CSS/tableReserve.css">
    <link rel="stylesheet" href="../CSS/about.css">
    <link rel="stylesheet" href="../CSS/package.css">
 
    

    
    <!-- Animate on Scroll library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <!-- JavaScript file with defer attribute for asynchronous loading -->
    <script src="../JS/script.js" defer></script>

   

   
</head>
<script>
 
  window.onload = function() {
      <?php
      session_start();
      if(isset($_SESSION['status']) && $_SESSION['status']) {
        echo "$('#signinbtn').hide();"; 
      }
      else{echo "$('#userdrop').hide();";
        echo "$('#bookbtn').hide();";
        echo "$('#book-form').hide();";
        echo "$('#destination').hide();";
    }
      ?>
  };
</script>
<body>
    <!----Nav section---->
    <header class="header">
    <div id="menu-btn" class="fas fa-bars"></div>
    <a data-aos="zoom-in-left" data-aos-delay="150" href="../index.php" class="logo"> <i class="fas fa-paper-plane"></i>Easy Travel</a>
    <nav class="navbar">
        <a data-aos="zoom-in-left" data-aos-delay="300" href="../index.php#home" class="d-none d-md-block">home</a>
        <a data-aos="zoom-in-left" data-aos-delay="450" href="../index.php#services">services</a>
        <a data-aos="zoom-in-left" data-aos-delay="500" href="../index.php#about">about</a>
        <a data-aos="zoom-in-left" data-aos-delay="550" href="../index.php#gallery" class="d-none d-md-block">gallery</a>
        <div class="dropdown" id="userdrop">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
            if(isset($_SESSION['username'])){
                echo $_SESSION['username']; 
            } 
            ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form action="../PHP/packages.php" method="post">
                    <button class="dropdown-item text-danger" type="submit" name="logout">Logout</button>
                    <input type="hidden" name="logout" value="logout">
                </form>
                <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["logout"])){
                    unset($_SESSION['status']);
                    session_destroy(); // Destroy the session
                    header('Location: ../index.php'); // Redirect to index.php
                    exit(); // Terminate the script
                }
                ?>
            </div>
        </div>
    </nav>
    <a data-aos="zoom-in-left" data-aos-delay="600" href="../PHP/SignIn.php" id="signinbtn" class="btn">Sign in</a>
</header>

    <!----End Nav section---->
      
    <!-- header section ends -->

    <div class="heading1" style="background:url(../images/header-bg-2.png) no-repeat">
            <h1>packages</h1>
        </div>

    <!-- packages section starts  -->

    <!-- packages section starts  -->

    <section class="packages">

<h1 class="heading-title">top destinations</h1>

<div class="box-container">

   <div class="box">
      <div class="image">
      <img src="../images/punta-cana.jpg" alt="">
      </div>
      <div class="content">
         <h3>punta-cana</h3>
         <p>Take your family to the Marinarium and spend a fun filled day around excellent rides, snorkeling and nursing the sharks.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
      <img src="../images/popeye-village.jpg" alt="">
      </div>
      <div class="content">
         <h3>Popeye village</h3>
         <p>known as Sweethaven Village,  apart from the film set itself, has a number of family attractions for the visitor to experience.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
      <img src="../images/maldives.jpg" alt="">
      </div>
      <div class="content">
         <h3>Maldives</h3>
         <p>A very special day indeed. You wonder if you made the right decision to come to the Maldives for Valentine’s day.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/Kapadokya, Türkiye.jpg" alt="">
      </div>
      <div class="content">
         <h3>Kapadokya, Türkiye</h3>
         <p>is an area in Central Anatolia in Turkey best known for its unique moon-like landscape, cave churches and houses in the rocks.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/London.jpg" alt="">
      </div>
      <div class="content">
         <h3>London, United Kingdom</h3>
         <p>London is a diverse and exciting city with some of the world's best sights, attractions and activities.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/img-6.jpg" alt="">
      </div>
      <div class="content">
         <h3>Surfing</h3>
         <p>. Today, we're still the dreamers, the doers, and we break the rules to give you a vastly superior experience... </p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/img-7.jpg" alt="">
      </div>
      <div class="content">
         <h3>Travels</h3>
         <p>Looking to get more out of your travels? Join our Team and get you travel stories & tips not shared on the blog.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/Paris.jpeg" alt="">
      </div>
      <div class="content">
         <h3>Paris, France</h3>
         <p> people usually try to spend there as much time as possible, and you also may be lucky enough to spend an autumn house.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/PALAWAN.jpeg" alt="">
      </div>
      <div class="content">
         <h3>Palawan Island</h3>
         <p>the best island destination in Asia region. If you ever came to Palawan, you must visit the Calauit Game Preserve and peaceful wildlife sanctuaries.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/maldives.jpg" alt="">
      </div>
      <div class="content">
         <h3>Maldives</h3>
         <p>Among the top 10 reasons to visit the Maldives will be to make the best out of water sports like kayaking, canoeing, sea bobbing, jet-skiing etc...</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/croatiaa1.jpg" alt="">
      </div>
      <div class="content">
         <h3>City walls, Croatia</h3>
         <p>is considered one of the top 10 places to visit around the world. It also voted the most beautiful national parks in the world.</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

   <div class="box">
      <div class="image">
         <img src="../images/Yakutsk, Russia.jpeg" alt="">
      </div>
      <div class="content">
         <h3>Yakutsk, Russia</h3>
         <p> the coldest inhabited part of the world. With a land area similar to India. the most northern district on mainland Yakutia...</p>
         <a href="book.php" class="btn1">book now</a>
      </div>
   </div>

</div>


</section>

    <!-- packages section ends -->


    <!--footer1 section---->
    <section class="footer" id="footer">
            <div class="box-container d-flex align-items-center ">

                <div class="box col-lg-6 " data-aos="fade-up" data-aos-delay="150">
                <a href="#" class="logo"> <i class="fas fa-paper-plane"></i>WHY USE OUR TRAVEL ? </a>
                    <p>Because with us you will find only the best travel offers for you. Our special travel deals search engine searches all the best worldwide travel sites and also local travel agencies. And offers you the best travel match that you are searching for.</p>
                    <div class="share d-flex justify-content-center">
                        <a href="#" class="fab fa-facebook-f"></a>
                        <a href="#" class="fa-brands fa-x-twitter"></a>
                        <a href="#" class="fab fa-instagram"></a>
                        <a href="#" class="fab fa-linkedin"></a>
                    </div>

                </div>

                <div class="box col-lg-4 d-none d-md-block" data-aos="fade-up" data-aos-delay="300">
                    <h3>quick links</h3>
                    <a href="../index.php" class="links"> <i class="fas fa-arrow-right"></i> home </a>
                    <a href="../index.php#about" class="links"> <i class="fas fa-arrow-right"></i> about </a>
                    <a href="../index.php#destination" class="links"> <i class="fas fa-arrow-right"></i> destination </a>
                    <a href="../index.php#services" class="links"> <i class="fas fa-arrow-right"></i> services </a>
                    <a href="../index.php#gallery" class="links"> <i class="fas fa-arrow-right"></i> gallery </a>
                    <a href="Book.php" class="links"> <i class="fas fa-arrow-right"></i> Book </a>
                </div>

                <div class="box col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="450">
                    <h3>contact info</h3>
                    <p> <i class="fas fa-map"></i> Morocco</p>
                    <p> <i class="fas fa-phone"></i> +212612345678</p>
                    <p> <i class="fas fa-envelope"></i> pfa.emsit@gmail.com </p>
                    <p> <i class="fas fa-clock"></i>24/7 Guide Service</p>
                </div>

            </div>
            <div>

            </div>

     </section>
     <!--End footer1 section---->

    <!-- footer2 section -->
    <footer class="footer credit">
        <div class="container d-flex justify-content-center align-items-center">
        <p class="text-muted text-center small">
            &copy; <span id="displayYear"></span> PFA. All rights reserved.
        </p>
        </div>
    </footer>
  <!-- End footer2 section -->

    <!-- AOS library for scroll animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- jQuery library -->  
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="../JS/bootstrap.js"></script>
    <!-- SweetAlert library for beautiful alerts -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/63c9b41866.js" crossorigin="anonymous"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!--Online bootsrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


   <script>
   AOS.init({
        duration: 800,
        offset: 150,});
    </script>

 
</body>

</html>