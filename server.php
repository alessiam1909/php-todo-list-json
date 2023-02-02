<?php

session_start();

include __DIR__ . '/functions.php';



//1° recuperare il contenuto di todo-list.json
//$string = file_get_contents('todo-list.json');

//2° convertire la stringa in array associativo
//$todo_list = json_decode($string, true);

$userData = getUserDataByEmail($_SESSION['email']);


$todo_list = $userData['todolist'];

//CHIAMATA DELLA FUNZIONE DI AGGIUNTA DI UN ELEMENTO
if (isset($_POST['language'])) {
    $todo_list = addTodo($todo_list, $_POST);
}

//CHIAMATA DELLA FUNZIONA DI RIMOZIONE DI UN ELEMENTO
if (isset($_POST['delete'])) {
    $todo_list = deleteTodo($todo_list, $_POST['delete']);
}

//CHIMATA DELLA FUNZIONE DI MODIFICA DI UN ELEMENTO
if (isset($_POST['edit'])) {
    $todo_list = editTodo($todo_list, $_POST);
}


header('Content-Type: application/json');
//echo $string;
//4° codifico in formato json l'array dopo aver aggiunto un elemento
echo json_encode($todo_list);