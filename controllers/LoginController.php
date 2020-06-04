<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'):
    session_start();
    include_once('../modules/User.php');
    class   Login{

        public $email;  
        public $password;  
        public $username;
        public $errors = [];
    function __construct($data){
        
            $this->email    = addslashes(strip_tags(trim($data['email'])));
            $this->password = addslashes(strip_tags(trim($data['password'])));
    }

    function validate(){

            // Validate Email
            if(!isset($this->email)){

                $this->errors['email'] = "Empty Email Field";
            }
            if(!filter_var($this->email,274)){

                $this->errors['email'] = "Wrong Email Format";
            }
            // Validate Password
            if(!isset($this->password) ){

                $this->errors['password'] = "Empty password Field";
            }
            if(strlen($this->password) <= 8 ){

                $this->errors['password'] = "Short password";
            }
    }

    function __toString(){

            return ['email'=>$this->email,'password'=>$this->password];
    }
    function __destruct(){

        $this->errors = [];
        $this->email    = '';
        $this->password = '';
    }
    }

    $app = new Login($_POST);
    $app->validate();
    if(count($app->errors) > 0){
        echo json_encode(['status'=>3,'message'=>$app->errors]);
        exit();
    }

    try{

        $user = new User($app);
        $record = $user->auth();
        $_SESSION['userId'] = $record['id'];
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