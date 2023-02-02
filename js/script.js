const { createApp } = Vue;

createApp({
    data() {
        return {
            apiUrl: 'server.php',
            todoList: [],
            language: '',
            errorMessage: '',
            clicked: ''
        }
    },
    methods: {
        //AGGIUNTA DI UN ELEMENTO
        addTodo() {

            const data = {
                language: this.language,
                done: false,
            }

            if (this.language.trim() != '' && this.language != '') {
                axios.post(this.apiUrl, data, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                }).then((response) => {
                    this.language = '';

                    this.todoList = response.data;
                    this.errorMessage = '';
                })
            }
            else {
                this.errorMessage = 'Non puoi inserire una stringa vuota';
            }
        },
        //CANCELLAZIONE DI UN ELEMENTO
        deleteTodo(index) {

            const ciccio = {
                delete: index
            }

            axios.post(this.apiUrl, ciccio, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then((response) => {
                this.todoList = response.data
            });
        },
        //MODIFICA DI UN ELEMENTO
        editTodo(index) {
            this.clicked = index
        },
        confirmUpdate(string, index) {
            const data = {
                edit: index,
                language_edit: string
            }

            axios.post(this.apiUrl, data, {
                headers: { 'Content-Type': 'multipart/form-data' }
            }).then((response) => {
                this.todoList = response.data
                this.clicked = ''
            });
        }
    },
    mounted() {
        axios.get(this.apiUrl).then((response) => {
            //Convertire una stringa passata da php a oggetto json
            // let json_object = JSON.parse(response.data);
            //console.log(json_object);
            this.todoList = response.data;
        });
    }
}).mount('#app');