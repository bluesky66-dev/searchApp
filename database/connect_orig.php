<?php 
 try{
        $db = new PDO("mysql:host=localhost;dbname=tu24oesr_googlesearchapp","tu24oesr_searchG","nX]sVV&nWgiN");
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
   }
?>