<?php

namespace framework\ORM;

class user{
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;

    // Getters and Setters for the variables

    function __construct($name, $newEmail, $newPw, $newRole, $newId = 0)
    {
        $this->username = $name;
        $this->email = $newEmail;
        $this->password = $newPw;
        $this->role = $newRole;
        $this->id - $newId;
    }

        public function getId(){
            return $this->id;
        }

        public function setId($newId){
            $this->id = $newId;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUsername($newUsername){
            $this->username = $newUsername;
        }

        public function getPassword(){
            // ***Reverse the hashing then compare / just compare hashed
            return $this->password;
        }

        public function setPassword($newPw){
            $this->password = $newPw;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($newEmail){
            $this->email = $newEmail;
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($newRole){
            $this->role = $newRole;
        }


    }