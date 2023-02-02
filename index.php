<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>To-Do list php</title>
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Todo-List</h1>
                    <ul>
                        <li v-for="todo in todoList" >
                            {{todo.language}}
                        </li>
                    </ul>
                    <form>
                        <input type="text" v-model="language" placeholder="Aggiungi elemento">
                        <button type="submit" @click="addToDoItem">Inserisci elemento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.1/axios.min.js" integrity="sha512-NbjaUHU8g0+Y8tMcRtIz0irSU3MjLlEdCvp82MqciVF4R2Ru/eaXHDjNSOvS6EfhRYbmQHuznp/ghbUvcC0NVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/script.js"></script>

</body>
</html>