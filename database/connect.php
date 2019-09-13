<?php 
 try{
        $db = new PDO("mysql:host=localhost;dbname=gmm78659_bmvsearchapp","gmm78659_bmvsear","ookapath123!");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
   }
?>