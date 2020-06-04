<?php

function getTodos($database){

        // Find Todos
      $database->prepare("SELECT * FROM todo WHERE userId = ?");
      $database->execute([$_SESSION['userId']]);

      if($database->rowCount() > 0){

        return ['status'=>true,'todos'=>$database->fetchMore()];
      }
       return ['status'=>false,'todos'=>[]];

}
function delete($database,$id){

       // Delete Todos
      $database->prepare("DELETE FROM todo WHERE id = ?");
      $database->execute([$id]);
      if($database->rowCount() > 0){

        return true;
      }

      return false;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' ){

  if($_POST['type'] == 'delete'){

    include_once('../database/config.php');
    $res = delete(new Database(),$_POST['todoId']);
    echo json_encode(['status'=>$res]);
  }
}
?>