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
    <link rel="stylesheet" type="text/css" href="CSS/bootstrap.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    

    <!-- Custom stylesheets -->
    <link rel="stylesheet" href="./CSS/header.css">
    <link rel="stylesheet" href="./CSS/service.css">
    <link rel="stylesheet" href="./CSS/tableReserve.css">
    
 
    

    
    <!-- Animate on Scroll library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    
    <!-- JavaScript file with defer attribute for asynchronous loading -->
    <script src="JS/script.js" defer></script>

   

   
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
    <a data-aos="zoom-in-left" data-aos-delay="150" href="#" class="logo"> <i class="fas fa-paper-plane"></i>Easy Travel</a>
    <nav class="navbar">
        <a data-aos="zoom-in-left" data-aos-delay="300" href="#home" class="d-none d-md-block">home</a>
        <a data-aos="zoom-in-left" data-aos-delay="450" href="#services">services</a>
        <a data-aos="zoom-in-left" data-aos-delay="500" href="#about">about</a>
        <a data-aos="zoom-in-left" data-aos-delay="550" href="#gallery" class="d-none d-md-block">gallery</a>
        <div class="dropdown" id="userdrop">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
            if(isset($_SESSION['username'])){
                echo $_SESSION['username']; 
            } 
            ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <form action="index.php" method="post">
                    <button class="dropdown-item text-danger" type="submit" name="logout">Logout</button>
                    <input type="hidden" name="logout" value="logout">
                </form>
                <?php
                if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["logout"])){
                    unset($_SESSION['status']);
                    session_destroy(); // Destroy the session
                    header('Location: index.php'); // Redirect to index.php
                    exit(); // Terminate the script
                }
                ?>
            </div>
        </div>
    </nav>
    <a data-aos="zoom-in-left" data-aos-delay="600" href="./PHP/SignIn.php" id="signinbtn" class="btn">Sign in</a>
</header>

    <!----End Nav section---->
      

    <!-- home section starts  -->

    <section class="home" id="home">
        <div class="content">
            <span data-aos="fade-up" data-aos-delay="150">follow us</span>
            <h3 data-aos="fade-up" data-aos-delay="300">To Find Cheap Flights</h3>
            <p data-aos="fade-up" data-aos-delay="450">Explore the best flight deals for weekend travel <br>
                Follow us on Instagram to see our best flight deals</p>
            <a data-aos="fade-up" data-aos-delay="600" href="./PHP/packages.php" class="btn" id="bookbtn">book now</a>
        </div>

    </section>
    <!-- End home section ends -->

    <!-- booking form section starts  -->
    
    <section class="book-form" id="book-form">
    <form action="./index.php" method="post" class="form">
        <div data-aos="zoom-in" data-aos-delay="150" class="inputBox">
            <span> &nbsp; &nbsp; &nbsp; Departure city :</span>
            <input type="" placeholder="place name" value="" style="color:white" id="depar" name="depart" required>
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span> &nbsp; &nbsp; &nbsp;Arrival city :</span>
            <input type="" placeholder="place name" value="" id="arrive"  name="arrive" required>
        </div>
        <div data-aos="zoom-in" data-aos-delay="300" class="inputBox">
            <span> &nbsp; &nbsp; &nbsp;Guests :</span>
            <input type="number" placeholder="Number" value="1" id="guests"  name="guests" required>
        </div>
        <div data-aos="zoom-in" data-aos-delay="350" class="inputBox">
            <span>&nbsp; &nbsp; &nbsp; when?</span>
            <input type="date"  name="dated" id="dated">
        </div>
        <button  type="submit" value="find now" class="btn" id="find" name="find">find now</button>
    </form>
</section>

<?php
     
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['find'])) {
     
        include('./PHP/Database.php');
        $pdo=DataBase::connect("127.0.0.1","easytravel","root","");
        if($pdo==NULL){echo "<script>console.log('Not connect')</script>";}
        else{echo "<script>console.log('connected')</script>";}
        $depart = strtoupper(trim($_POST['depart']));
        $arrive = strtoupper(trim($_POST['arrive']));
        $guest= $_POST['guests'];
        $_SESSION['guest']=$_POST['guests'];
        $_SESSION['depart']=$depart;
        $date = $_POST['dated'];
        $pattern_text = "/^[a-zA-Z]{2,}$/";
        if (preg_match($pattern_text, $depart) && preg_match($pattern_text, $arrive)) {
            $records = DataBase::getReservationOP($pdo, $depart, $arrive, $date);
           

            if (!empty($records)) { // Check if records exist before proceeding
                echo "<div style='margin: 66px; padding:20px; font-size:18px' data-aos='zoom-in' data-aos-delay='300'>";
                echo "<center><table class='  table-hover  table-responsive-lg'>"
                ;
                echo "<tr>";
                echo "<th>Code</th>"; 
                echo "<th>Vdepart</th>";
                echo "<th>Hdepart</th>";
                echo "<th>Varrivée</th>";
                echo "<th>Harrivée</th>";
                echo "<th>DateDEPART</th>"; 
                echo "<th>DateARRIVE</th>"; 
                echo "<th>Prix</th>"; 
                echo "<th>Reserve</th>";
                echo "</tr>";
                foreach ($records as $record) {
                    $ids= $record['ID'];
                    $stmt=$pdo->query("SELECT Available_Seats FROM planes WHERE VOYAGE=$ids");
                    $record2=$stmt->fetch(PDO::FETCH_ASSOC);
                    echo "<script>console.log(".$guest.")</script>";
                    if($record['AVAILABILITY']==="YES" && $guest <= $record2['Available_Seats'] ){
                    echo "<tr>";
                    echo "<td ><center>".$record['ID']."</center></td>"; 
                    echo "<td><center>".$record['DEPART']."</center></td>";
                    echo "<td><center>".$record['ARRIVE']."</center></td>";
                    echo "<td><center>".$record['HDEPART']."</center></td>";
                    echo "<td><center>".$record['HARRIVE']."</center></td>"; 
                    echo "<td><center>".$record['DateDEPART']."</center></td>";
                    echo "<td><center>".$record['DateARRIVE']."</center></td>";
                    echo "<td><center>".$record['PRIX']."</center></td>";
                    echo '
                            <td>
                                <center>
                                    <form action="./index.php" method="post">
                                        <input type="hidden" name="idvoyage" value="' . $record['ID'] . '">
                                        <button type="submit" class="bt" name="proceed">Proceed</button>
                                    </form>
                                </center>
                            </td>
                        ';



                    echo "</tr>";
                }}
                echo "</table></center></div> ";
               
                DataBase::disconnect($pdo);
            } else {echo "<center><h2 data-aos='zoom-in' data-aos-delay='300'>PAS DE TRAJET !!</h2></center>";}
        } else {echo "<p>Please enter valid departure and arrival cities.</p>";}
    }
?>
<?php
     if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['proceed']) && isset($_POST['idvoyage'])) {
       
        $_SESSION['idvoyage'] = $_POST['idvoyage'];
        $_SESSION['type']="voyage";
       
        echo "<script>window.location.href = './PHP/payment.php'</script>";
        
    }



?>
   <!-- End booking form section starts  -->
   
    <!--Services section---->
    <section class="services" id="services">
        <h1 class="heading-title text-center"> our services </h1>
        <div class="box-container col-lg-12 col-md-8 ">
        
            <div class="box " data-aos="zoom-out-down" data-aos-delay="300">
                <img src="images/icon-1.png" alt="">
                <h3>adventure</h3>
            </div>

            <div class="box" data-aos="zoom-out-down" data-aos-delay="400">
                <img src="images/icon-2.png" alt="">
                <h3>tour guide</h3>
            </div>

            <div class="box" data-aos="zoom-out-down" data-aos-delay="450">
                <img src="images/icon-3.png" alt="">
                <h3>trekking</h3>
            </div>

            <div class="box"data-aos="zoom-out-down" data-aos-delay="500">
                <img src="images/icon-4.png" alt="">
                <h3>camp fire</h3>
            </div>

            <div class="box" data-aos="zoom-out-down" data-aos-delay="550">
                <img src="images/icon-5.png" alt="">
                <h3>off road</h3>
            </div>

            <div class="box" data-aos="zoom-out-down" data-aos-delay="600">
                <img src="images/icon-6.png" alt="">
                <h3>camping</h3>
            </div>

        </div>
    </section>
    <!--End Services section---->

    <!--About section---->
    <section class="about" id="about">
        <div class="video-container" data-aos="fade-right" data-aos-delay="300">
            <video src="images/about-vid-2.mp4" muted autoplay loop class="video"></video>
            <div class="controls">
                <span class="control-btn" data-src="images/about-vid-2.mp4"></span>
                <span class="control-btn" data-src="images/about-vid-1.mp4"></span>
                <span class="control-btn" data-src="images/about-vid-3.mp4"></span>
            </div>
        </div>

        <div class="content" data-aos="fade-left" data-aos-delay="400">
            <h3>About Us</h3>
            <span>Deal Finders with a Passion for Travel</span>
            <p>Travelling is run by a group of people really passionate about travel — and we get pretty excited about finding great deals. Every day, we search over 20,000 routes to find only the best fares available on trips you want to take. And we’ve been doing this for more than 10 years, so we know a great deal when we see it!</p>
            <a  class="btn1" onclick="popUp()">read more</a>
        </div>
    </section>
    <!--End About section---->
    
    <!--Package section---->
    <section class="home-packages" id="destination">
        <h1 class="heading-title"> our packages </h1>
        <center><span style=" color: #61a5c2;font-size: 2.5rem;">Check out Our Vacation Package Deals!</span></center>
        <br>
        <br>
        <br>
        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="images/punta-cana.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Paris-Punta-cana</h3>
                    <p>Take your family to the Marinarium and spend a fun filled day around excellent rides, snorkeling
                        and nursing the sharks.</p>
                    <?php
                        $data = [
                            'depart' => 'PARIS',
                            'arrive' => 'PUNTA CANA',
                            'ID' => 2
                        ];
                        $query_string = http_build_query($data);
                        $url= './PHP/book.php?'.$query_string;
                        echo '<a href="' . htmlspecialchars($url) . '" class="btn1">Book Now</a>';
                    ?>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/popeye-village.jpg" alt="">
                </div>
                <div class="content">
                    <h3>London-Popeye village</h3>
                    <p>known as Sweethaven Village, is open to the public seven days a week and, apart from the film set
                        itself.Enjoy your ultimate vacation</p>
                    <a href="book.php" class="btn1">book now</a>
                </div>
            </div>

            <div class="box">
                <div class="image">
                    <img src="images/maldives.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Yakutsk-Maldives</h3>
                    <p>Wake up to the rhythm of waves washing ashore in the Maldives. Your loved one is by your side.
                         - a very special day indeed.</p>
                    <a href="book.php" class="btn1">book now</a>
                </div>
            </div>

        </div>

        <div class="load-more"> <a href="./PHP/packages.php" class="btn2">load more</a> </div>
    </section>
    <!--End Package section---->


    <!--Gallery section---->
    <section class="gallery d-none d-lg-block " id="gallery">
        <div class="heading">
            <h3 class="heading-title">our gallery</h3>
            <span style="color:#61a5c2">we record memories</span>
        </div>

        <div class="box-container">
            <div class="box " data-aos="zoom-in-up" data-aos-delay="100">
                <img src="images/couple.jpg" alt="">
                <span>walk around </span>
                <h3>Maldives</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="120">
                <img src="images/gallery-img-2.jpg" alt="">
                <span>travel spot</span>
                <h3>greenland</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="130">
                <img src="images/journey.jpg" alt="">
                <span>traveling</span>
                <h3>Shot of the day</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="140">
                <img src="images/gallery-img-4.jpg" alt="">
                <span>travel spot</span>
                <h3>thailand</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="150">
                <img src="images/gallery-img-5.jpg" alt="">
                <span>travel spot</span>
                <h3>brazil</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="160">
                <img src="images/ga1.jpg" alt="">
                <span>travel dreams</span>
                <h3>Couples</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="170">
                <img src="images/gallery-img-7.jpg" alt="">
                <span>travel spot</span>
                <h3>iceland</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="180">
                <img src="images/gallery-img-8.jpg" alt="">
                <span>travel spot</span>
                <h3>alaska</h3>
            </div>

            <div class="box" data-aos="zoom-in-up" data-aos-delay="190">
                <img src="images/gallery-img-9.jpg" alt="">
                <span>travel spot</span>
                <h3>maldive</h3>
            </div>

        </div>
    </section>
    <!--End Gallery section---->
    
    <!--Slider section---->
  
    
    <!--End Slider section---->

    <!--Book section---->
    <section class="home-offer d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h3 class="heading-title">YOU DESERVE A VACATION</h3>
            <p style="font-size:1.5rem">“DOMESTIC FLIGHTS, INTERNATIONAL FLIGHTS, FIRST AND BUSINESS CLASS FLIGHTS, PARTNER PERKS BY FAR THE BEST SOLUTION OUT THERE.”</p>
            <a class="btn1" onclick="popUp()">book now</a>
        </div>
    </section>
    <!--End Book section---->

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

                <div class="box col-lg-4 d-none d-md-block" data-aos="fade-up" data-aos-delay="200">
                    <h3>quick links</h3>
                    <a href="../index.php" class="links"> <i class="fas fa-arrow-right"></i> home </a>
                    <a href="#about" class="links"> <i class="fas fa-arrow-right"></i> about </a>
                    <a href="#destination" class="links"> <i class="fas fa-arrow-right"></i> destination </a>
                    <a href="#services" class="links"> <i class="fas fa-arrow-right"></i> services </a>
                    <a href="#gallery" class="links"> <i class="fas fa-arrow-right"></i> gallery </a>
                    <a href="Book.php" class="links"> <i class="fas fa-arrow-right"></i> Book </a>
                </div>

                <div class="box col-lg-6 d-none d-lg-block" data-aos="fade-up" data-aos-delay="250">
                    <h3>contact info</h3>
                    <p> <i class="fas fa-map"></i> Morocco</p>
                    <p> <i class="fas fa-phone"></i> +212681474112</p>
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
    <script src="JS/jquery-3.6.0.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="JS/bootstrap.js"></script>
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
        offset: 150
    });

    function popUp() {
        <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] == true) {
            echo "window.location.href = './PHP/packages.php';";
        } else {
            echo 'swal("What are you waiting for", "Sign up to find out more!");';
        }
        ?>
    }
</script>


 
</body>

</html>