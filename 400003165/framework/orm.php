<?php

namespace framework;
use PDO;
use Exception;
use controller\user;

require_once __DIR__ . "/../../autoloader.php";

class orm{

    public $conn;

    public function startConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=user_management_system", $username, $password);

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Database Connected successfully";
        } 
        catch(Exception $e) {
            throw $e;
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public function addUser($name, $email, $pw, $role = "Researcher"){
        $pw = password_hash($pw, PASSWORD_DEFAULT);

        $query = $this->conn->prepare("INSERT INTO `users`(`id`, `username`, `password`, `email`, `role`) VALUES (NULL, :name, :pw, :email, :role)");
            // Using bindParam to reduce secutiry risk (SQL Injection)
        $query->bindParam(':name', $name);
        $query->bindParam(':pw', $pw);
        $query->bindParam(':email', $email);
        $query->bindParam(':role', $role);

        $query->execute();
        
        // $query = $this->conn->prepare("INSERT INTO `users`(`id`, `username`, `password`, `email`, `role`) VALUES ('NULL','" . $name . "' ,'" . $pw . "','" . $email . "','" . $role . "')");
        // $query->execute();
        
        $idQuery = $this->conn->prepare("SELECT id FROM `users` WHERE username = ':idName' ");
        $query->bindParam(':idName', $name);

        $idQuery->execute();

        $result = $idQuery->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $id = $result['id'];
            echo $id;
        }        

        $newUser = new user($name, $email, $pw, $role, $id);
        
        $newUser->setId($id);

        return $newUser;
    }

    // Functions for checking if something is in the db
    public function isInDb($field, $data){
        $queryString = "SELECT * FROM `users` WHERE :field = ':data'";
        
        $query = $this->conn->prepare($queryString);
        $query->bindParam(':field', $field);
        $query->bindParam(':data', $data);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if( sizeof($result) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }

    public function doubleIsInDb($field1, $field2, $data1, $data2){
        $queryString = "SELECT * FROM `users` WHERE :field1 = ':data1' AND :field2 = ':data2' ";
        $query = $this->conn->prepare($queryString);

        $query->bindParam(':field1', $field1);
        $query->bindParam(':field2', $field2);
        $query->bindParam(':data1', $data1);
        $query->bindParam(':data2', $data2);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if( sizeof($result) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }


    public function searchDb($field, $data){
        $queryString = "SELECT * FROM `users` WHERE :field = ':data'";
        $query = $this->conn->prepare($queryString);

        $query->bindParam(':field', $field);
        $query->bindParam(':data', $data);

        $query->execute();

        $array = array();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if(sizeof($result) > 0){
            
            foreach($result as $row){
                $user = new user($row['username'], $row['email'], $row['password'], $row['role'], $row['id'],);
                array_push($array, $user);
            }
            return $array;
        }
        else{
            throw new \Exception("Result not found");
        }
    }


    public function doubleSearchDb($field1, $field2, $data1, $data2){
        $queryString = "SELECT * FROM `users` WHERE :field1 = ':data1' AND :field2 = ':data2' ";
        $query = $this->conn->prepare($queryString);

        $query->bindParam(':field1', $field1);
        $query->bindParam(':field2', $field2);
        $query->bindParam(':data1', $data1);
        $query->bindParam(':data2', $data2);

        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if(sizeof($result) > 0){

            foreach($result as $row){
                $user = new user($row['username'], $row['email'], $row['password'], $row['role'], $row['id'],);
                array_push($array, $user);
            }
            return $array;
        }
        else{
            throw new \Exception("Result not found");
        }
    }
}