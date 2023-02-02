<?php






session_start();
include 'functions.php';

$test = setUserTodoListByEmail($_SESSION['email'], []);

?>