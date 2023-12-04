<?php

require_once "ConDB.php";

class UserModel{

    static public function createUser($data){
        $cantMail = self::getMail($data["use_mail"]);
           var_dump($data);

        if($cantMail == 0){
            $query = "INSERT INTO users (use_id,use_mail,use_pass,use_dataCreate,us_identifier,us_key,us_status) 
                      VALUES (NULL, :use_mail, :use_pass, :use_dataCreate, :us_identifier, :us_key, :us_status)";
            $status = "0";
            $statement = Connection::connection()->prepare($query);
            $hashedPassword = password_hash($data["use_pss"], PASSWORD_DEFAULT);
            $statement->bindParam(":use_mail", $data["use_mail"], PDO::PARAM_STR);
            $statement->bindParam(":use_pass", $data["use_pass"], PDO::PARAM_STR);
            $statement->bindParam(":use_dataCreate", $data["use_dataCreate"], PDO::PARAM_STR);
            $statement->bindParam(":us_identifier", $data["us_identifier"], PDO::PARAM_STR);
            $statement->bindParam(":us_key", $data["us_key"], PDO::PARAM_STR);
            $statement->bindParam(":us_status", $status, PDO::PARAM_STR);
            $message = $statement->execute() ? "ok" : Connection::connection()->errorInfo();
            
            $statement->closeCursor();
            $statement = null;
            $query ="";

        } else {
            $message = "El usuario ya existe"; 
        }

        return $message;
    }

    static private function getMail($mail){
        $query = "SELECT use_mail FROM users WHERE use_mail = '$mail'";
        $statement = Connection::connection()->prepare($query);
        $statement-> execute();
        return $statement->rowCount();
    }

    static public function getUsers($parametro) {
        $param = is_numeric($parametro) ? $parametro : 0;
        $query = "SELECT use_id, use_mail, use_dateCreate FROM users WHERE us_status = '1'";
        $params = [];
    
        if ($param > 0) {
            $query .= " AND use_id = :param";
            $params[':param'] = $param;
        }
    
        $statement = Connection::connection()->prepare($query);
        $statement->execute($params);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    static private function getStatus($id) {
        $query = "SELECT us_status FROM users WHERE use_id = :id";
        $statement = Connection::connection()->prepare($query);
        $statement->execute([':id' => $id]);
        return $statement->fetchColumn() ?: null;
    }    

    static public function update($id, $data) {
        if (!isset($data['use_mail'], $data['use_pss'])) {
            return ["error" => "Datos incompletos"];
        }
    
        $hashedPassword = password_hash($data['use_pss'], PASSWORD_DEFAULT);
    
        $query = "UPDATE users SET use_mail = :use_mail, use_pass = :use_pass WHERE use_id = :use_id";
        $params = [
            'use_mail' => $data['use_mail'],
            'use_pass' => $hashedPassword,
            'use_id' => $id
        ];
    
        try {
            self::executeUpdateQuery($query, $params);
            return ["msg" => "Usuario actualizado"];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el usuario: " . $e->getMessage()];
        }
    }
    
    static private function executeUpdateQuery($query, $params) {
        $statement = Connection::connection()->prepare($query);
        $statement->execute($params);
    }    

    static public function updateStatus($id) {
        $newStatus = self::getNewStatus(self::getStatus($id));
        $query = "UPDATE users SET us_status = :new_status WHERE use_id = :user_id";
        
        try {
            self::executeStatusUpdateQuery($query, $newStatus, $id);
            return ["msg" => "Estado del usuario actualizado"];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el estado del usuario: " . $e->getMessage()];
        }
    }    
    
    static private function getNewStatus($status) {
        return abs(1 - $status);
    }
    
    static private function executeStatusUpdateQuery($query, $newStatus, $id) {
        $statement = Connection::connection()->prepare($query);
        $statement->execute([':new_status' => $newStatus, ':user_id' => $id]);
    }    
    static public function activateUser($id) {
        $currentStatus = self::getStatus($id);
        $newStatus = ($currentStatus === 0) ? 1 : 0;
        $query = "UPDATE users SET us_status = :new_status WHERE use_id = :user_id";
    
        try {
            self::executeStatusUpdateQuery($query, $newStatus, $id);
            return ["msg" => "Estado del usuario actualizado"];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el estado del usuario: " . $e->getMessage()];
        }
    }

    static public function login($data){
        //print_r($data)
        $user = $data['use_mail']; 
        $pass = ($data['use_pass']); 
        
        if(!empty($user) && !empty($pass)){
            $query="SELECT us_identifier,us_key, use_id FROM users WHERE use_mail = '$user' AND use_pass='$pass' AND us_status='1'";
            //var_dump($query);
            $statement = Connection::connection()->prepare($query);
            $statement-> execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }else{
            return "NO TIENE CREDENCIALES";
        }
    }

    static public function getUserAuth(){
        $query="";
        $query="SELECT us_identifier,us_key FROM users WHERE us_status = '1'";
        $statement = Connection::connection()->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }   
}
?>

