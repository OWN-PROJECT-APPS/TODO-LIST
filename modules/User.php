<?php
include_once('../database/config.php');
class User{

    private $fullname;
    private $email;
    private $password;
    private $database;
    
function __construct($data=null){

        $this->email    = $data->email;
        $this->fullname  = $data->username;
        $this->password = $data->password;
        $this->database = new Database();
    }

// Add User
function save(){

   // Check If Email Already Used Before

    if($this->findOne($this->email)){
           // Insert New User
      $this->database->prepare("INSERT INTO users(fullname,email,`password`) Values(?,?,?)");
      $this->database->execute([$this->fullname,$this->email,password_hash($this->password,PASSWORD_DEFAULT)]);
      
      if($this->database->rowCount() > 0){

           return $this->database->lastInsertId();
      }

       throw new Exception("Wrong Add User In Database");
       return false;

    }
    // If User Already Had Account

    throw new Exception("Email Already Used");
    return false;

    }
// Search For User By Id
 function  findById($id){

       $this->database->prepare("SELECT * FROM users WHERE id = ?");
       $this->database->execute([$id]);

       if($this->database->rowCount() > 0){

            return $this->database->fetchOne();
    }
    
        throw new Exception("Wrond User Session");
        return false;
}
// Find User By Email
function findOne($email){

    $this->database->prepare("SELECT * FROM users WHERE email = ?");
    $this->database->execute([$email]);

    if($this->database->rowCount() > 0){

            return false;
        }
        
           return true;
}

// function auth

function auth(){

    $this->database->prepare("SELECT * FROM users WHERE email = ?");
    $this->database->execute([$this->email]);

       if($this->database->rowCount() > 0){
            
            $user =  $this->database->fetchOne();

            if(password_verify($this->password,$user['password'])){

                return $user;
            }

         throw new Exception("Wrong Password !");
        return false;
    }
    
        throw new Exception(" Email Not Registred !");
        return false;

}

}