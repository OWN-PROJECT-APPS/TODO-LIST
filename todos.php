<?php
session_start();
if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])):
        include_once('./functions/todosOperation.php');
        include_once('./database/config.php');
        $username = $_SESSION['username'];
        $email    = $_SESSION['email'];
        $data     = getTodos(new Database());
else: 
    
    header('location:index.php');
    exit();
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Todo List For Any User">
    <meta name="author" content="Chliah Younes">
    <meta name="keywords" content="Activites,Todos">
    <!-- icons -->
    <link rel="stylesheet" href="/assets/fonts/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <!-- Plugins -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap.min.css">
    <!-- Styles   -->
    <link rel="stylesheet" href="/assets/css/todos.css">
    <link rel="shortcut icon" href="/assets/image/trading-stocks.jpg" type="image/x-icon">
    <title>Welcom In Todo List Home Page</title>

</head>

<body>

    <nav class="row justify-content-between align-items-center mx-0 bg-light shadow p-3">

        <div class="logo col-3">
            <span>T <i class="fa fa-cog"></i><i class="fa fa-cog"></i>DS</span></div>
        </div>

        <div class="avatar col-9 text-right position-relative">
            <span class="mr-1"><?php echo $username ; ?></span>
            <img class="rounded-circle" src="/assets/image/trading-stocks.jpg" alt="avatar" title='avatar'>
            <a href="/functions/logout.php" class="logout" title='sign out'><i
                    class="fas fa-sign-out-alt text-dark"></i></a>
        </div>
    </nav>

    <section class="row flex-column bg-light shadow mt-4 p-4 mx-auto w-50 text-center">
        <p class="todoInfo text-info"> Add Your Todo List <span
                class="badge badge-info ml-1"><?php echo count($data['todos'])?></span></p>
        <div class="form-group" id="form">
            <input type="text" name="todoname" id="todoname" class="form-control" placeholder="Enter Name Of Todo">
            <input type="text" class="form-control my-2" placeholder="Enter Description Of Todo" name="tododesc"
                id="tododesc">
            <input type="date" name="datetime" id="datepicker" class="form-control">
            <button type="submit" class="btn btn-primary form-control mt-2" id="addTodo">Add </button>
            <button type="submit" class="btn btn-success form-control mt-2" id="updateTodo">Update </button>
        </div>

    </section>
    <section class="row flex-column bg-light shadow mt-4 p-4 mx-auto w-50 text-center list-todos">
        <?php 
          
            if($data['status']){

                foreach($data['todos'] as $key=>$val){
         ?>
        <div class="form-group text-left bg-light shadow p-3" data-todoId="<?php echo $val['id']?>">
            <div class="d-flex justify-content-between">
                <span class="todo-name">
                    <i class="fas fa-angle-double-right mr-1"></i>
                    <span><?php   echo $val['todoName']; ?></span>
                </span>
                <span class="arrow text-dark"> <span
                        class="date mr-2 <?php if(strtotime($val['todoDate']) - time() <  0):echo 'missed';endif; ?>"><?php  echo $val['todoDate']; ?></span>
                    <i class="fa fa-chevron-down"></i>
                </span>
            </div>
            <div class="mt-4 todo-detailes">
                <p class="todo-desc pl-3">
                    <?php  echo $val['todoDescription']; ?>
                </p>
                <span class="options float-right">
                    <i class="fa fa-edit text-success px-2"></i>
                    <i class="fa fa-trash-alt text-danger"></i>
                </span>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </section>
    <section class="alert notify position-fixed"></section>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/todos.js"></script>
</body>

</html>