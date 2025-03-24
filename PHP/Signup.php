<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sign up</title>
    <script
      src="https://kit.fontawesome.com/b6b9586b26.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../CSS/sign.css" />
    

  </head>
  <body>
  <?php
    include('../PHP/Database.php');
    $pdo=DataBase::connect("127.0.0.1","easytravel","root","");
    if($pdo==NULL){echo "<script>console.log('Not connect')</script>";}
    else{echo "<script>console.log('connected')</script>";}  
    $status=false;
  ?>
  <video autoplay muted loop id="myVideo">
    <source src="../images/Be.mp4" type="video/mp4">
  </video>

  <div id="sign_up">
    <form action="../PHP/Signup.php" method="POST" oninput='cpassword.setCustomValidity(password.value != cpassword.value ? "Passwords do not match." : "")'>
      <span>Sign Up</span>
      <div id="field">
          <label><i class="fas fa-user"></i></label>
          <input type="text" placeholder="Username" required name="username" pattern="[a-zA-Z0-9_]{2,}" title="Username should be at least 2 characters long and can contain letters, numbers, and underscores." />
      </div>

      <div id="field">
          <label><i class="fas fa-envelope-open"></i></label>
          <input type="email" placeholder="Email Address" required name="email" pattern="\S+@\S+\.\S+" title="Please enter a valid email address." />
      </div>

      <div id="field">
          <label><i class="fas fa-lock"></i></label>
          <input type="password" placeholder="Password" required name="password" pattern=".{8,}" title="Password should be at least 8 characters long." />
      </div>

      <div id="field">
          <label><i class="fas fa-lock"></i></label>
          <input type="password" placeholder="Confirm Password" required name="cpassword" pattern=".{8,}" title="Please enter the same password as above." />
      </div>

      <div id="field">
          <input type="submit" value="Register" name="save" />
      </div>
  </form>


      <p>
        Already a member?
        <button ><a href="../PHP/SignIn.php">Sign in now</a></button>
        <i class="fas fa-arrow-right"></i>
      </p>
    </div>
    <?php


      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $pass = $_POST['password'];
                    DataBase::InsertionUsers($pdo,$username,$email,$pass,$status);
                    if($status===true){
                      session_start();
                      $_SESSION['status']=$status;
                      $_SESSION['username']=$username;
                      header("location:../index.php");
                    } }
    ?>


  </body>
</html>
