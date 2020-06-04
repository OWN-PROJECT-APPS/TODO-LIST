<?php
include_once('../database/config.php');
class Todo{

    public $name;
    public $description;
    public $date;
    public $database;

function __construct($data){

    $this->name = $data->name;
    $this->description = $data->description;
    $this->date = $data->date;
    $this->database = new Database();
}

function  save($userId){
           // Insert New Todo
      $this->database->prepare("INSERT INTO todo(todoName,todoDescription,todoDate,userId) Values(?,?,?,?)");
      $this->database->execute([$this->name,$this->description,$this->date,$userId]);
      
      if($this->database->rowCount() > 0){

           return $this->findById($this->database->lastInsertId());
      }
       throw new Exception("Wrong Insert Todo");
       return false;

    
}

function findById($todoId){

            // Find Todo
      $this->database->prepare("SELECT * FROM todo WHERE id = ?");
      $this->database->execute([$todoId]);

      if($this->database->rowCount() > 0){

        return $this->database->fetchOne();
      }

    throw new Exception("Wrong TODO Id");
    return false;
}

function update($todoId){

        // Update Todos
      $this->database->prepare("UPDATE todo SET todoName = ? , todoDescription = ? , todoDate = ? WHERE id = ?");
      $this->database->execute([$this->name,$this->description,$this->date,$todoId]);
      if($this->database->rowCount() > 0){

        return true;
      }

      throw new Exception("Nothing Updated !");
      return false;
}
    
}