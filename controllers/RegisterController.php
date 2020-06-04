<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'):
    session_start();
    include_once('../modules/User.php');
    class RegisterController{

    public $username;  
    public $email;  
    public $password;  
    private $password_confirmation;  
    public $errors = [];
    function __construct($data){

            $this->username = filter_var($data['fullname'],FILTER_SANITIZE_STRING);
            $this->email    = strip_tags(trim($data['registeremail']));
            $this->password = addslashes(trim($data['registerpassword']));
            $this->password_confirmation = $data['registerpassword_confirmation'];
        }

    function validate(){
            // Validate Full Name
            if(!isset($this->username)){

                $this->errors['fullname'] = "Empty Full Name Field";
            }
            if(preg_match_all("/[^a-zA-Z]/",$this->username)){

                $this->errors['fullname'] = "Wrong String Format";
            }
            // Validate Email
            if(!isset($this->email)){

                $this->errors['email'] = "Empty Email Field";
            }
            if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){

                $this->errors['email'] = "Wrong Email";
            }
            // Validate Password
            if(!isset($this->password,$this->password_confirmation) ){

                $this->errors['password'] = "Empty password Field";
            }
            if(strlen($this->password) <= 8 ){

                $this->errors['password'] = "Short password";
            }
            if($this->password !== $this->password_confirmation){

                $this->errors['password'] = "Password Not Match";
            }
        }

    function __toString(){

            return ['username'=>$this->username,'email'=>$this->email,'password'=>$this->password];
        }
    }

    $app = new RegisterController($_POST);
    $app->validate();
    if(count($app->errors) > 0){

        echo json_encode(['status'=>3,'message'=>$app->errors]);
        exit();
    }

    try{

        $user = new User($app);
        $userId = $user->save();
        $record = $user->findById($userId);
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $record['fullname'];
        $_SESSION['email'] = $record['email'];
        session_regenerate_id();
        echo json_encode(['status'=>1,'message'=>'todos.php']);

    }catch(Exception $e ){

        echo json_encode(array('status'=>2,'message'=>$e->getMessage()));
    }
else:
        header('location:/index.php');
        exit();
endif;