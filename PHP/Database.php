<?php
    class DataBase{
        public static function connect($host, $dbname, $username, $password) {
            try {
                $dsn = "mysql:host=$host;dbname=$dbname";
                $pdo = new PDO($dsn, $username, $password);
                // Set PDO to throw exceptions on error
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<script>console.log('DataBase connected ')</script>";
                return $pdo;
            } catch(PDOException $e) {
                // Handle connection errors
                echo "Connection failed: " . $e->getMessage();
                return null; // Or handle the error in an appropriate way
            }
        }

        public static function disconnect(PDO &$pdo){$pdo=null;unset($pdo);
            echo "<script>console.log('DataBase disconnected ')</script>";}
        
        public static function InsertionUsers($pdo,$username,$email,$password,&$status){
            $sql="INSERT INTO USERS (USERNAME,EMAIL,PASSWORD) VALUES(:U,:E,:P)";
            $stmt=$pdo->prepare($sql);
            $stmt->BindParam(':U',$username);
            $stmt->BindParam(':E',$email);
            $stmt->BindParam(':P',password_hash($password,PASSWORD_DEFAULT));
            try{
                $stmt->execute();
                echo "<script>console.log('Inserted successfully')</script>";
                $status=true;
            }catch(PDOException $e){
                echo "<script>console.log('Not Inserted ')</script>";
                $status=false;
                if($e->errorInfo[1]==1062){echo "<table><th style=color:RED;>UserExist</th></table>";}
                else{echo "<table><tr><th style=color:RED;>".$e->getMessage()."</th></tr></table>";}
            }
        }

        public static function AllFetchUsers($pdo){
            $stmt=$pdo->query("SELECT * FROM USERS");
            $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
                if($records!==NULL){
                    echo "<script>console.log('Fetch successfully')</script>";
                    return $records;} 
                else{
                    echo "<script>console.log('Fetch FAILED')</script>";
                    return NULL;}   
        }

        public static function SignInUsers($pdo, $username, $password) {
            $sql = "SELECT * FROM USERS WHERE USERNAME=:U";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':U', $username);
            try {
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user) {
                    // Verify password
                    if (password_verify($password, $user['PASSWORD'])) {
                        // Password is correct
                        return $user;
                    } else {
                        // Password is incorrect
                        return NULL;
                    }
                } else {
                    // Username not found
                    return NULL;
                }
            } catch (PDOException $e) {
                // Handle other database errors
                echo "<table><tr><th style=color:RED;>" . $e->getMessage() . "</th></tr></table>";
                return NULL;
            }
        }

        public static function getReservationOP($pdo, $depart, $arrive, $date) {
            if ($date ==="") {
                $stmt = $pdo->prepare("SELECT * FROM VOYAGE_VIEW WHERE DEPART = :depart AND ARRIVE = :arrive");
                $stmt->execute(array(':depart' => $depart, ':arrive' => $arrive));
            } else {
                $stmt = $pdo->prepare("SELECT * FROM VOYAGE_VIEW WHERE DEPART = :depart AND ARRIVE = :arrive AND DateDEPART = :date");
                $stmt->execute(array(':depart' => $depart, ':arrive' => $arrive, ':date' => $date));
            }
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }
        
        public static function InsertReservation($pdo,$iduser,$idtravel,$type,$qte){
            $sql="";
            if($type ==="voyage" ||$type ==="package"){
                $sql="INSERT INTO VOYAGES_HISTORY(USER,VOYAGE,QTE) VALUES(:U,:T,:Q)";}
            else{   echo "<script>console.log('Insertion failed due to type ')</script>"; return NULL;}
            $stmt=$pdo->prepare($sql);
            $stmt->BindParam(':U',$iduser);
            $stmt->BindParam(':T',$idtravel);
            $stmt->BindParam(':Q',$qte);
            try{
                $stmt->execute();
                echo "<script>console.log('Inserted successfully')</script>";
            }catch(PDOException $e){
                echo "<script>console.log('Not Inserted ')</script>";
                echo '<script>console.log('.$e->getMessage().')</script>';
            }

        }
        public static function FetchUser($pdo, $username) {
            try {
                // Prepare a SQL statement using prepared statements to prevent SQL injection
                $stmt = $pdo->prepare("SELECT * FROM USERS WHERE USERNAME = :username");
        
                // Bind the parameter
                $stmt->bindParam(':username', $username);
        
                // Execute the query
                $stmt->execute();
        
                // Fetch the user record
                $record = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($record !== false) {
                    // User found
                    echo "<script>console.log('Fetch successfully')</script>";
                    return $record;
                } else {
                    // User not found
                    echo "<script>console.log('User not found')</script>";
                    return null;
                }
            } catch (PDOException $e) {
                // Handle any errors that occur during the query
                echo "<script>console.log('Error fetching user: " . $e->getMessage() . "')</script>";
                return null;
            }
        }
        
    }

?>