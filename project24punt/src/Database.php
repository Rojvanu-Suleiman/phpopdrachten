<?php
 
class Database {
 
 
    public static function connectDb(){
        // Maak een database connectie met PDO
        try {
            // Opties voor de PDO connectie
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
 
            // Gebruik correcte DSN met constants uit config.php
 
            $conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DATABASE,
                    USERNAME, PASSWORD, $options);      
            //echo "Connected successfully";
            return $conn;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
 
     }
}