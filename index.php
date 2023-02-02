<?php

include __DIR__ . '/functions.php';

session_start();


//controllo se l'utente ha inserito la mail nel form POST
// e che la mail sia presente nel file todo-list.json
if (isset($_POST['email']) && emailExists($_POST['email'])) {

    //recupero tutti i dati legati a questa mail
    $userData = getUserDataByEmail($_POST['email']);

    if ($userData['password'] === $_POST['password']) {
        //qui ho un utente valido, la sessione è ok
        $_SESSION['email'] = $_POST['email'];
        //rimuovo eventuali errori precedenti
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
    } else {
        $_SESSION['error'] = 'Password non valida';
        header('Location: login.php');
    }
} else {
    $_SESSION['error'] = 'Email non valida';
    header('Location: login.php');
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.1/axios.min.js" integrity="sha512-NbjaUHU8g0+Y8tMcRtIz0irSU3MjLlEdCvp82MqciVF4R2Ru/eaXHDjNSOvS6EfhRYbmQHuznp/ghbUvcC0NVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>To-Do list php</title>
</head>
<body>
    <div id="app">
        <div class="container1">
            <div class="row1">
                <h1 class="titolo">Todo List</h1>
                <div class="col1">
                    <ul class="ul">
                        <li class="elemento-lista" v-for="(todo, index) in todoList" >
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div v-if="clicked != index">{{todo.language}}</div>
                                    <div v-else>
                                        <div class="row">
                                                <div class="col-9">
                                                    <input type="text" v-model="todo.language" :placeholder="(errorMessage != '') ? errorMessage : 'Linguaggio'" class="form-control">
                                                </div>
                                                <div class="col-3">
                                                    <button class="btn btn-primary" @click="confirmUpdate(todo.language, index)">Conferma</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="m-1 btn btn-square btn-warning" @click="editTodo(index)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="m-1 btn btn-square btn-danger" @click="deleteTodo(index)">
                                         <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="w-50 mt-3">
                                <div class="row">
                                    <div class="col-9">
                                        <input type="text" v-model="language" :placeholder="(errorMessage != '') ? errorMessage : 'Linguaggio'" class="form-control">
                                    </div>
                                    <div class="col-3">
                                        <button class="btn btn-primary" @click="addTodo">Inserisci</button>
                                    </div>
                                </div>
                                <div class="row" v-if="errorMessage != ''">
                                    <p class="mt-2 text-danger text-center"><strong>{{ errorMessage }}</strong></p>
                                </div>
                            </div>
            </div>
        </div>
    </div>
    
    <script src="./js/script.js"></script>

</body>
</html>