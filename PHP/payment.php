
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>PaymentGateway</title>

    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Custom stylesheets -->

    <link rel="stylesheet" href="../CSS/header.css">
    
    <link rel="stylesheet" href="../CSS/proceedbtn.css"> 
    <link rel="stylesheet" href="../CSS/diagonalbtn.css"> 
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
    <?php
        
        $cardVisibility = 'display: none;';
        $cardVisibility2 = 'display: block;';
        $cardVisibility3 = 'display: none;'; // Default to hide the card
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subbtn'])){
            $choice = $_POST['payment'];
            if($choice == "visa" || $choice == "mastercard" ){
                echo '<link rel="stylesheet" href="../CSS/card.css">';
                $cardVisibility = 'display: block;'; // Show the card if visa or mastercard is chosen
                
                $cardVisibility2 = 'display: none;';
            }
            else if ($choice == "metamask"){
                echo '<link rel="stylesheet" href="../CSS/me.css">';
                $cardVisibility3 = 'display: block;'; 
                $cardVisibility2 = 'display: none;';
            }
        }
        else{
            echo '<link rel="stylesheet" href="../CSS/payment.css">';
        }
    ?>
    <!-- JavaScript file with defer attribute for asynchronous loading -->
    <script src="../JS/script.js" defer></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php
            session_start();
            if(isset($_SESSION['status']) && $_SESSION['status']) {
                echo "$('#signinbtn').hide();";
            } else {
                echo "$('#userdrop').hide();";
            }
            ?>
        });

        window.addEventListener('load', function() {
            if (typeof window.ethereum === 'undefined') {
                var label = document.getElementById('metamask');
                var Span = document.getElementById('idspan');
                label.disabled = true;
                label.style.color = 'gray'; 
                Span.innerText = "Not Installed";
                label.style.pointerEvents = 'none'; 
            }
        });

        async function connectToMetaMask() {
            if (window.ethereum) {
                web3 = new Web3(window.ethereum);
                try {
                    await window.ethereum.request({ method: 'eth_requestAccounts' });
                    console.log("Connected to MetaMask");
                    checkContractEvents(); // Call to check events after successful connection
                } catch (error) {
                    console.error("User denied account access:", error);
                }
            } else {
                console.error("MetaMask is not installed");
            }
        }

        async function checkContractEvents() {
            const accounts = await web3.eth.getAccounts();
            const account = accounts[0];

            const contractABI = [
                {
                    "inputs": [
                        {
                            "internalType": "address payable[]",
                            "name": "_addrs",
                            "type": "address[]"
                        }
                    ],
                    "stateMutability": "nonpayable",
                    "type": "constructor"
                },
                {
                    "anonymous": false,
                    "inputs": [
                        {
                            "indexed": false,
                            "internalType": "address",
                            "name": "_from",
                            "type": "address"
                        },
                        {
                            "indexed": false,
                            "internalType": "uint256",
                            "name": "_amount",
                            "type": "uint256"
                        }
                    ],
                    "name": "TransferReceived",
                    "type": "event"
                },
                {
                    "stateMutability": "payable",
                    "type": "receive"
                },
                {
                    "inputs": [],
                    "name": "recipients",
                    "outputs": [
                        {
                            "internalType": "address payable[]",
                            "name": "",
                            "type": "address[]"
                        }
                    ],
                    "stateMutability": "view",
                    "type": "function"
                }
            ];
            const contractAddress = "0x486076d0191cc3929b3d2dd6e99812dd90c46ac0"; // Your contract address
            const contract = new web3.eth.Contract(contractABI, contractAddress);

            contract.events.TransferReceived({ filter: { _from: account } })
                .on('data', function(event) {
                    console.log("Event received:", event);
                    window.location.href = '../PHP/receipt.php'; // Redirect to receipt.php
                })
                .on('error', console.error);
        }

        window.addEventListener('load', async () => {
            await connectToMetaMask();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>

</head>
<body>
    <?php if(isset($_SESSION['idvoyage'])) {echo "<script>console.log('ID voyage: ".$_SESSION['idvoyage']."')</script>";
    echo "<script>console.log('type: ".$_SESSION['type']."')</script>";
    echo "<script>console.log('Guests: ".$_SESSION['guest']."')</script>";

}
    
    ?>
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
               <form action="../PHP/payment.php" method="post">
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
   <a data-aos="zoom-in-left" data-aos-delay="600" href="./PHP/SignIn.php" id="signinbtn" class="btn">Sign in</a>
</header>

   <!----End Nav section---->



    <!--Payment panel-->
    <div class="container" id="pay" style="<?php echo $cardVisibility2; ?>">
        <div class="title">
            <h4>Select a <span style="color: #6064b6">Payment</span> method</h4>
        </div>

        <form action="../PHP/payment.php" method="post">
            <input type="radio" name="payment" id="visa" value="visa" required>
            <input type="radio" name="payment" id="mastercard" value="mastercard">
            <input type="radio" name="payment" id="paypal" value="paypal">
            <input type="radio" name="payment" id="AMEX" value="metamask">


            <div class="category">
                <label for="visa" class="visaMethod">
                    <div class="imgName">
                        <div class="imgContainer visa">
                            <img src="https://i.ibb.co/vjQCN4y/Visa-Card.png" alt="">
                        </div>
                        <span class="name">VISA</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

                <label for="mastercard" class="mastercardMethod">
                    <div class="imgName">
                        <div class="imgContainer mastercard">
                            <img src="https://i.ibb.co/vdbBkgT/mastercard.jpg" alt="">
                        </div>
                        <span class="name">Mastercard</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

                <label for="paypal" class="paypalMethod">
                    <div class="imgName">
                        <div class="imgContainer paypal">
                            <img src="https://i.ibb.co/KVF3mr1/paypal.png" alt="">
                        </div>
                        <span class="name">Paypal</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>

                <label for="AMEX" class="amexMethod" id="metamask">
                    <div class="imgName">
                        <div class="imgContainer AMEX">
                            <img src="https://cdn.iconscout.com/icon/free/png-512/free-metamask-2728406-2261817.png?f=webp&w=256" alt="">
                        </div>
                        <span class="name" id="idspan">MetaMask</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #6064b6;"></i></span>
                </label>
            </div>
            <center><button type="submit" class="Btn" name="subbtn">Pay
                <svg class="svgIcon" viewBox="0 0 576 512"><path d="M512 80c8.8 0 16 7.2 16 16v32H48V96c0-8.8 7.2-16 16-16H512zm16 144V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V224H528zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm56 304c-13.3 0-24 10.7-24 24s10.7 24 24 24h48c13.3 0 24-10.7 24-24s-10.7-24-24-24H120zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24H360c13.3 0 24-10.7 24-24s-10.7-24-24-24H248z"></path></svg>
            </button></center>
        </form>
    </div>
    <!---Payment Panel end-->
    
    <!---Card panel --->
<div id="card" style="<?php echo $cardVisibility; ?>">
    <div class="container preload " >
    <div class="row">
        <div class="creditcard col-10 d-grid justify-content-center mt-5">

            <div class="front">
                <div id="ccsingle"></div>
                <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                    <g id="Front">
                        <g id="CardBackground">
                            <g id="Page-1_1_">
                                <g id="amex_1_">
                                    <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                            C0,17.9,17.9,0,40,0z" />
                                </g>
                            </g>
                            <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                        </g>
                        <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                        <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6"></text>
                        <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">cardholder name</text>
                        <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">expiration</text>
                        <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">card number</text>
                        <g>
                            <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                            <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                            <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                            <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" />
                        </g>
                        <g id="cchip">
                            <g>
                                <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                        c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                            </g>
                            <g>
                                <g>
                                    <rect x="82" y="70" class="st12" width="1.5" height="60" />
                                </g>
                                <g>
                                    <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                                </g>
                                <g>
                                    <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                            c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                            C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                            c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                            c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                                </g>
                                <g>
                                    <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                                </g>
                                <g>
                                    <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                                </g>
                                <g>
                                    <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                                </g>
                                <g>
                                    <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                                </g>
                            </g>
                        </g>
                    </g>
                    <g id="Back">
                    </g>
                </svg>
            </div>

            <div class="back">
                <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                    <g id="Front">
                        <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
                    </g>
                    <g id="Back">
                        <g id="Page-1_2_">
                            <g id="amex_2_">
                                <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                        C0,17.9,17.9,0,40,0z" />
                            </g>
                        </g>
                        <rect y="61.6" class="st2" width="750" height="78" />
                        <g>
                            <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                    C707.1,246.4,704.4,249.1,701.1,249.1z" />
                            <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                            <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                            <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                        </g>
                        <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">###</text>
                        <g class="st8">
                            <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">security code</text>
                        </g>
                        <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                        <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                        <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13"></text>
                    </g>
                </svg>
            </div>
        </div>
    </div>
    </div>
    <form action="../PHP/payment.php" method="post">
    <div class="form-container">
        <div class="field-container">
            <label for="name">Name</label>
            <input id="name" maxlength="20" type="text" name="name">
        </div>
        <div class="field-container">
            <label for="cardnumber">Card Number</label><span id="generatecard">generate random</span>
            <input id="cardnumber" type="text"  inputmode="numeric" name="cardnum">
            <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">

            </svg>
        </div>
        <div class="field-container">
            <label for="expirationdate">Expiration (mm/yy)</label>
            <input id="expirationdate" type="text"  inputmode="numeric" name="expiration">
        </div>
        <div class="field-container">
            <label for="securitycode">Security Code</label>
            <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric" name="securitycode">
        </div>
        <button class="cta" name="cardsubmit">
            <span>Proceed</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>

    </div>
    </form>
</div>
    <!---Card panel end --->
    
    <!---MetaMask --->
    <div class="container" id="pay" style="<?php echo $cardVisibility3; ?>">
        <div class="box col-lg-12 col-md-8 col-12">
            <i class="fa2">
                <img width="50px" height="50px" src="https://cdn.iconscout.com/icon/free/png-512/free-metamask-2728406-2261817.png?f=webp&w=256" alt="MetaMask Icon">
            </i>
            <div class="text">
                <i class="fa1">
                    <img width="50px" height="50px" src="https://cdn.iconscout.com/icon/free/png-512/free-metamask-2728406-2261817.png?f=webp&w=256" alt="MetaMask Icon">
                </i>
                <div class="col-xs-12">
                    <h3>CONTRACT</h3>
                    <p>MT:0.0001ETH</p>
                    <p id="quoteText">0x486076d0191cc3929b3d2dd6e99812dd90c46ac0</p>
                    <button class="btn btn-primary" onclick="copyText()">Copy</button>
                </div>
            </div>
        </div>
    </div>



    <!--- MetaMask end --->







    <?php
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['cardsubmit'])){
        include('../PHP/Database.php');
       
        $pdo = DataBase::connect("127.0.0.1","easytravel","root","");
        $usr=DataBase::FetchUser($pdo,$_SESSION['username']);
        if ($usr !== null) {
            DataBase::InsertReservation($pdo, $usr['ID'], $_SESSION['idvoyage'],$_SESSION['type'],$_SESSION['guest']);
            echo "<script>window.location.href = '../PHP/receipt.php'</script>";  
            DataBase::disconnect($pdo);
            unset($usr);
            exit();
        } 
        
        
        else {
            echo "User not found!";
            exit();
        }
      
       
    }

    ?>
 <script>
        function copyText() {
            var text = document.getElementById('quoteText').innerText;
            var textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
            alert('Text copied to clipboard');
        }
       
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js"></script>
    <script src="../JS/card.js" ></script>
    
</body>
</html>


