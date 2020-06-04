<?php
session_start();
if(isset($_SESSION['userId'])):

    session_unset();
    session_destroy();
    header('location:/');
    exit();
else:
    header('location:/');
    exit();
endif;


?>