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
    <link rel="stylesheet" href="../CSS/book.css">
 
    

    
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

        <div class="dropdown" id="userdrop">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
            if(isset($_SESSION['username'])){
                echo $_SESSION['username']; 
            } 
            ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form action="../PHP/book.php" method="post">
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

<div class="heading1" style="background:url(../images/header-bg-3.png) no-repeat">
   <h1 class="col-6">book now</h1>
</div>

<!-- booking section starts  -->

<section class="booking">
<?php
    include('../PHP/Database.php');
    $pdo = DataBase::connect("127.0.0.1", "easytravel", "root", "");

    if (isset($_GET['depart']) && isset($_GET['arrive']) && isset($_GET['ID'])) {
        $depart = $_GET['depart'];
        $arrive = $_GET['arrive'];
        $id = $_GET['ID'];
        $_SESSION['idvoyage']=$id;

        // Log the parameters to the console
        echo '<script>';
        echo 'var depart = ' . json_encode($depart) . ';';
        echo 'var arrive = ' . json_encode($arrive) . ';';
        echo 'var id = ' . json_encode($id) . ';';
        echo 'console.log("Departure: " + depart);';
        echo 'console.log("Arrival: " + arrive);';
        echo 'console.log("ID: " + id);';
        echo '</script>';

        // Prepare and execute the SQL query securely
        $stmt = $pdo->prepare("SELECT DateDepart, DateARRIVE FROM PACKAGES WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            // Log the fetched dates to the console
            echo '<script>';
            echo 'console.log("Date Depart: ' . addslashes($record['DateDepart']) . '");';
            echo 'console.log("Date Arrivee: ' . addslashes($record['DateARRIVE']) . '");';
            echo '</script>';
        } else {
            echo '<script>console.log("No record found for ID: ' . addslashes($id) . '");</script>';
        }
    } else {
        echo 'Some parameters are missing in the URL.';
    }

       
       ?>
   <h1 class="heading-title">book your trip!</h1>

   <form action="../PHP/book.php" method="post" class="book-form">

      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" placeholder="Enter your name" name="name" value="<?php echo $_SESSION['username']; ?>">

         </div>
         <div class="inputBox">
            <span>email :</span>
            <input type="email" placeholder="enter your email" name="email">
         </div>
         <div class="inputBox">
            <span>phone :</span>
            <input type="number" placeholder="enter your number" name="phone">
         </div>
         <div class="inputBox">
            <span>Depart :</span>
            <input type="text" placeholder="enter your address" name="depart" value=<?php echo  $depart; ?>>
         </div>
         <div class="inputBox">
            <span>Arrive :</span>
            <input type="text" placeholder="place you want to visit" name="arrive" value=<?php echo  json_encode($arrive); ?> >
         </div>
         <div class="inputBox">
            <span>how many :</span>
            <input type="number" placeholder="number of guests" name="guests" value="1">
         </div>
         <div class="inputBox">
            <span>arrivals :</span>
            <input type="date" name="arrivals" value=<?php  echo addslashes($record['DateDepart'])?>>
         </div>
         <div class="inputBox">
            <span>leaving :</span>
            <input type="date" name="leaving"value=<?php  echo addslashes($record['DateARRIVE']);?>>
         </div>
      </div>

      <button type="submit"  class="btn" name="send">Submit</button>

   </form>

   <?php
    DataBase::disconnect($pdo);
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
     
        $_SESSION['type']="package";
        $_SESSION['guest']=$_POST['guests'];
       
        echo "<script>";
        echo "console.log('Session idvoyage:', " . json_encode($_SESSION['idvoyage']) . ");";
        echo "console.log('Session type:', " . json_encode($_SESSION['type']) . ");";
        echo "console.log('Session guest:', " . json_encode($_SESSION['guest']) . ");";
        echo "</script>";
        echo "<script>window.location.href = '../PHP/payment.php'</script>";
        
    }
    ?>
</section>

<!-- booking section ends -->

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