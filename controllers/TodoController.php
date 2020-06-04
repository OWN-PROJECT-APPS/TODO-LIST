<?php

session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['userId'])){
    include_once('../modules/Todo.php');
    $userId = $_SESSION['userId'];
class TodoController{

    public $name;
    public $description;
    public $date;
    public $errors = [];

function __construct($data){

    $this->name        =   filter_var(trim($data['name']),FILTER_SANITIZE_STRING);
    $this->description =   filter_var(trim($data['description']),FILTER_SANITIZE_STRING);
    $this->date        =   addslashes(strip_tags(trim($data['date'])));

}

function validate(){
            // Validate Name
            if(!isset($this->name)){

                $this->errors['name'] = "Empty Name Field";
            }
           
            // Validate Description
            if(!isset($this->description)){

                $this->errors['description'] = "Empty Description Field";
            }
           
            // Validate Date
            if(!isset($this->date)){

                $this->errors['date'] = "Empty Date Field";
            }
}

function addTodo($id){

    $this->validate();
    if(count($this->errors) > 0){

        echo json_encode(['status'=>3,'message'=>$this->errors]);
        return;
    }
    
    try{

            $todo        = new Todo($this);
            $todoRecord  = $todo->save($id);
            echo json_encode(['status'=>1,'message'=>$todoRecord]);

        }catch(Exception $e ){

            echo json_encode(array('status'=>2,'message'=>$e->getMessage()));
    }
}
function updateTodo($id){
    $this->validate();
    if(count($this->errors) > 0){
            echo json_encode(['status'=>3,'message'=>$this->errors]);
            return;
    }
        
    try{

                $todo        = new Todo($this);
                $res         = $todo->update($id);
                echo json_encode(['status'=>$res]);
                return;
    }catch(Exception $e ){

                echo json_encode(array('status'=>2,'message'=>$e->getMessage()));
    }
}

Function __toString(){

            return ['name'=>$this->name,'decription'=>$this->decription,'date'=>$this->date];
 }

}

// Add TODO
if($_POST['type'] === 'add'){
    
    // Add TODO In Controller
    $app   = new TodoController($_POST);
    $app->addTodo($userId);
    exit();

}
// Update TODO
if($_POST['type'] === 'update'){
     // Add TODO In Controller
    $app   = new TodoController($_POST);
    $app->updateTodo($_POST['id']);
    exit();
}


}else{

        header('location:/index.php');
        exit();
}
?>