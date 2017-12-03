<?php
    function getDatabaseConnection() {
        $host = 'us-cdbr-iron-east-05.cleardb.net';
        $username = "b4b2c44328820e";
        $password = "27966c6b";
        $dbname = "heroku_ec49987c2231ba0"; 
        // Create connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConn; 
    }
    
    function getUsersThatMatchUserName() {
        $username = $_GET['username']; 
         $dbConn = getDatabaseConnection(); 
    
         $sql = "SELECT * from User WHERE username='$username'"; 
         
         $statement = $dbConn->prepare($sql); 
         $statement->execute(); 
         $records = $statement->fetchAll(); 
         echo json_encode($records); 
    }
    
    function validatePassword() {
        $username = $_GET['username']; 
        $password = $_GET['password'];
        //database logic to confirm that the password matches the stored password in the DB
        echo sha1($password); 
    }
    
    if ($_GET['action'] == 'validate-username' ) {
        getUsersThatMatchUserName(); 
    } else if ($_GET['action'] == 'validate-password') {
        
    }
 

?>
