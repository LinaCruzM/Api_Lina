<?php

require_once("config.php");

class Connection{

    public function __construct(){
        
    }
    static public function connection(){
        $con = false;
        try{
            $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8"."";
            $con = new PDO($data,DB_USERNAME,DB_PASSWORD);
            return $con;
        }catch(PDOException $e){
            $message = array(
                "COD"=>"000",
                "MSN"=>($e),
            );
            echo (($e->getMessage()));
        }
    }
}

?>