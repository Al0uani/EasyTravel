<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>login</title>
    <script src="https://kit.fontawesome.com/b6b9586b26.js"crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/sign.css" />
    
  <?php
    include('../PHP/Database.php');
    $pdo=DataBase::connect("127.0.0.1","easytravel","root","");
    if($pdo==NULL){echo "<script>console.log('Not connect')</script>";}
    else{echo "<script>console.log('connected')</script>";}  
  ?>

  </head>
  <body>
  <video autoplay muted loop id="myVideo">
    <source src="../images/Be.mp4" type="video/mp4">
  </video>


    <div id="sign_in">
      <form action="../PHP/SignIn.php" method="POST">
        <span>Sign In</span>
        <div id="field">
          <label><i class="fas fa-user"></i></label>
          <input type="text" placeholder="Username" required name="username" />
        </div>

        <div id="field">
          <label><i class="fas fa-lock"></i></label>
          <input type="password" placeholder="Password" required  name="password"/>
        </div>

        <div id="field">
          <input type="submit" value="Log in" name="connexion" />
        </div>
      
      </form>
    <?php
      if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['connexion'])){
        $username = strtoupper(trim($_POST['username']));
        $pass = trim($_POST['password']);
        $records=DataBase::SignInUsers($pdo,$username,$pass);
        if($records!==NULL){
              session_start();
              $_SESSION['status']=true;
              $_SESSION['username']=$username;
              header("location:../index.php");
    
          }
          else{
            $_SESSION['status']=false;
            echo "<table><th style='color: red;'>username or password incorrect</th></table>";
          }

      }

    
    
    
    
    
    ?>
      <p>
        Not a member?
        <button ><a href="../PHP/Signup.php">Sign up now</a></button>
        <i class="fas fa-arrow-right"></i>
      </p>
    </div>
    </body>
</html>