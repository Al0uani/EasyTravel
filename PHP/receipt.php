<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TICKET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="../CSS/ti.css">
    <link rel="stylesheet" href="../CSS/print_ticket.css">
</head>

<body>
<style>
        /* Add your responsive CSS here */
        /* Example: */
        @media screen and (max-width: 600px) {
            /* Adjust styles for smaller screens */
            .title {
                font-size: 20px;
            }
        }
    </style>
<?php 
    session_start(); 
    $usr = $_SESSION['username'];
    $id = $_SESSION['idvoyage'];
    include('../PHP/Database.php');
    $pdo = DataBase::connect("127.0.0.1","easytravel","root","");
    $stmt = $pdo->query("SELECT * FROM VOYAGE_VIEW WHERE ID=$id");
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $depart="";$dated="";
    $arrive="";$datea="";$prix=0;$hdepart="";
    foreach($records as $record) {
        echo "<script>console.log('DEPART: ".$record['DEPART']."')</script>";
        $depart=$record['DEPART'];$arrive=$record['ARRIVE'];$dated=$record['DateDEPART'];
        $datea=$record['DateARRIVE'];$prix=$record['PRIX'];$hdepart=$record['HDEPART'];
        $flightNum=$record['PLANE'];
        echo "<script>console.log('ARRIVE: ".$record['ARRIVE']."')</script>";
    }
    DataBase::disconnect($pdo);
?> 


    <Center>
    
        <div id="canvas_div_pdf">
            <main class="ticket-system">
                <div class="top">
                    <h1 class="title" id="t1">Wait a second, your ticket is being printed</h1>
                    <div class="printer">
                </div>
                <div class="receipts-wrapper" id="test">
                    <div class="receipts">
                        <div class="receipt" id="test2">
                            
                            <a   class="airliner-logo"> <i class="fas fa-paper-plane"></i>Easy
                                Travel
                                     </a>
                            <div class="route">
                                <?php
                                  echo" <h2> $depart</h2>";
                                  ?>
                                <svg class="plane-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510 510">
                                    <path fill="#61a5c2"
                                        d="M497.25 357v-51l-204-127.5V38.25C293.25 17.85 275.4 0 255 0s-38.25 17.85-38.25 38.25V178.5L12.75 306v51l204-63.75V433.5l-51 38.25V510L255 484.5l89.25 25.5v-38.25l-51-38.25V293.25l204 63.75z" />
                                </svg>
                                <?php
                                     echo" <h2>$arrive</h2>";
                                    ?>
                            </div>
                            <div class="details">
                                <div class="item">
                                    <span>Passanger</span>
                                    <?php
                                     echo" <h3>$usr</h3>";
                                    ?>
                                </div>
                                <div class="item">
                                    <span>Flight No.</span>
                                    <?php
                                      echo" <h3>$flightNum  </h3>";
                                   ?>
                                </div>
                                
                                <div class="item">
                                    <span>Departure</span>
                                    <?php
                                      echo" <h3>$dated  </h3>";
                                   ?>
                                </div>
                                <div class="item">
                                    <span>TIME</span>
                                    <?php
                                        echo" <h3>$hdepart </h3>";
                                     ?>
                                </div>
                                <div class="item">
                                    <span>Luggage</span>
                                    <h3>Hand Luggage</h3>
                                </div>
                                <div class="item">
                                    <span>prix</span>
                                    <?php echo" <h3>$prix MAD</h3>"; ?>
                                </div>
                            </div>
                        </div>
                        <div class="receipt qr-code">
                            <svg class="qr" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29.938 29.938">
                                <path
                                    d="M7.129 15.683h1.427v1.427h1.426v1.426H2.853V17.11h1.426v-2.853h2.853v1.426h-.003zm18.535 12.83h1.424v-1.426h-1.424v1.426zM8.555 15.683h1.426v-1.426H8.555v1.426zm19.957 12.83h1.427v-1.426h-1.427v1.426zm-17.104 1.425h2.85v-1.426h-2.85v1.426zm12.829 0v-1.426H22.81v1.426h1.427zm-5.702 0h1.426v-2.852h-1.426v2.852zM7.129 11.406v1.426h4.277v-1.426H7.129zm-1.424 1.425v-1.426H2.852v2.852h1.426v-1.426h1.427zm4.276-2.852H.002V.001h9.979v9.978zM8.555 1.427H1.426v7.127h7.129V1.427zm-5.703 25.66h4.276V22.81H2.852v4.277zm14.256-1.427v1.427h1.428V25.66h-1.428zM7.129 2.853H2.853v4.275h4.276V2.853zM29.938.001V9.98h-9.979V.001h9.979zm-1.426 1.426h-7.127v7.127h7.127V1.427zM0 19.957h9.98v9.979H0v-9.979zm1.427 8.556h7.129v-7.129H1.427v7.129zm0-17.107H0v7.129h1.427v-7.129zm18.532 7.127v1.424h1.426v-1.424h-1.426zm-4.277 5.703V22.81h-1.425v1.427h-2.85v2.853h2.85v1.426h1.425v-2.853h1.427v-1.426h-1.427v-.001zM11.408 5.704h2.85V4.276h-2.85v1.428zm11.403 11.405h2.854v1.426h1.425v-4.276h-1.425v-2.853h-1.428v4.277h-4.274v1.427h1.426v1.426h1.426V17.11h-.004zm1.426 4.275H22.81v-1.427h-1.426v2.853h-4.276v1.427h2.854v2.853h1.426v1.426h1.426v-2.853h5.701v-1.426h-4.276v-2.853h-.002zm0 0h1.428v-2.851h-1.428v2.851zm-11.405 0v-1.427h1.424v-1.424h1.425v-1.426h1.427v-2.853h4.276v-2.853h-1.426v1.426h-1.426V7.125h-1.426V4.272h1.426V0h-1.426v2.852H15.68V0h-4.276v2.852h1.426V1.426h1.424v2.85h1.426v4.277h1.426v1.426H15.68v2.852h-1.426V9.979H12.83V8.554h-1.426v2.852h1.426v1.426h-1.426v4.278h1.426v-2.853h1.424v2.853H12.83v1.426h-1.426v4.274h2.85v-1.426h-1.422zm15.68 1.426v-1.426h-2.85v1.426h2.85zM27.086 2.853h-4.275v4.275h4.275V2.853zM15.682 21.384h2.854v-1.427h-1.428v-1.424h-1.427v2.851zm2.853-2.851v-1.426h-1.428v1.426h1.428zm8.551-5.702h2.853v-1.426h-2.853v1.426zm1.426 11.405h1.427V22.81h-1.427v1.426zm0-8.553h1.427v-1.426h-1.427v1.426zm-12.83-7.129h-1.425V9.98h1.425V8.554z" />
                            </svg>
                            <div class="description">
                            <?php echo" <h3>$usr</h3>"; ?>
                                <p>Show QR-code when requested</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
              
        </div>
        </div>

        
        <input type="submit" value="Print" class="btn" onclick="printfile()" id="i1">
        <a href="../index.php" class="btn">Home</a>
    </Center>
    <div class="html2pdf__page-break"></div>
    
<script src="../JS/jquery-3.6.0.min.js"></script>

<script>
    function printfile(){
        window.print();
    }
</script>

</body>

</html>