<?php

/**
 * Controlla
 *
 * @param string $email
 * @return bool - true if email exists, false otherwise
 */
function emailExists($email)
{
    //1° recuperare il contenuto di todo-list.json
    $string = file_get_contents('todo-list.json');
    //2° convertire la stringa in array associativo
    $users = json_decode($string, true);

    $flag = false;
    foreach ($users as $user) {
        if ($email == $user['email']) {
            $flag = true;
        }
    }

    return $flag;
}

/**
 * Recupera tutti i dati di un utente presenti nel file json a partire dalla sua mail
 *
 * @param string $email
 * @return array|void - restituisce un array associativo con i dati dell'utente se la mail esiste, non restituisce niente altrimenti
 */
function getUserDataByEmail($email)
{
    //1° recuperare il contenuto di todo-list.json
    $string = file_get_contents('todo-list.json');
    //2° convertire la stringa in array associativo
    $users = json_decode($string, true);

    foreach ($users as $user) {
        if ($email == $user['email']) {
            return $user;
        }
    }
}

/**
 * Salva nel file json la todolist dell'utente con email uguale a quella fornita nel parametro
 *
 * @param string $email
 * @param array $todoList
 * @return void
 */
function setUserTodoListByEmail($email, $todoList)
{
    //1° recuperare il contenuto di todo-list.json
    $string = file_get_contents('todo-list.json');
    //2° convertire la stringa in array associativo
    $users = json_decode($string, true);


    foreach ($users as $key => $user) {
        if ($email == $user['email']) {
            $users[$key]['todolist'] = $todoList;
        }
    }


    //3° scrivo il dato all'interno del file json
    file_put_contents('todo-list.json', json_encode($users, JSON_PRETTY_PRINT));

    return json_encode($users, JSON_PRETTY_PRINT);
}


function addTodo($todo_list, $post)
{


    //AGGIUNTA DI UN ELEMENTO


    //ALTRO MODO PER EFFETTUARE L'AGGIUNTA DI UN ELEMENTO
    // $todo_item = $_POST['language'];
    // $done = $_POST['done'];

    // $todo_array = [
    //     "language" => $todo_item,
    //     "done"  => $done,
    // ];

    // $todo_array = $_POST;
    //FINE ESEMPIO ALTERNATIVO

    //aggiungo in coda un nuovo elemento all'array

    $todo_list[] = $post;


    //3° scrivo il dato all'interno del file json
    //file_put_contents('todo-list.json', json_encode($todo_list, JSON_PRETTY_PRINT));
    setUserTodoListByEmail($_SESSION['email'], $todo_list);

    return $todo_list;
}


//CANCELLAZIONE DI UN ELEMENTO DALL'ARRAY
function deleteTodo($todo_list, $index)
{

    unset($todo_list[$index]);

    file_put_contents('todo-list.json', json_encode($todo_list, JSON_PRETTY_PRINT));

    return $todo_list;
}

//MODIFICA DI UN ELEMENTO DALL'ARRAY
function editTodo($todo_list, $post)
{

    $replacement = array(
        //INDIVIDUA L'ELEMENTO AVENTE INDICE CONTENUTO IN $_POST['EDIT] E LO SOSTITUISCE CON IL SUO VALORE CORRISPONDENTE CHE IN QUESTO CASO E' L'ARRAY
        $post['edit'] => array(
            "language"  => $post['language_edit'],
            "done"      => false
        )
    );

    $todo_list = array_replace($todo_list, $replacement);

    file_put_contents('todo-list.json', json_encode($todo_list, JSON_PRETTY_PRINT));

    return $todo_list;
}