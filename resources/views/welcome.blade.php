<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <style>
            body {
                padding-top: 50px;
            }
            em {
                color: #5bc0de;
            }

            .results {
                height: 500px;
                overflow: scroll;
            }
        </style>
    </head>
    <body>
        
        <div class="container" id="app">
            <div class="form-group">
                <input type="text" class="form-control input-lg" placeholder="Search users" v-model="query" debounce="500">
            </div>
            <div class="results">
                <p>Total result : @{{ users.length }}</p>
                <ul class="list-group">
                    <li class="list-group-item" v-for="user in users" v-if="users.length">
                        <p><span class="label label-default">Name :</span> @{{{ user.name }}} </p>
                        <p><span class="label label-default">Email :</span> @{{{ user.email }}} </p>
                    </li>
                    <li class="list-group-item">
                        <p v-show="loading">Loading...</p>
                        <p v-show="!loading && !users.length">No result...</p>
                    </li>
                </ul>
            </div>
        </div>

    <script src="js/vue.js"></script>
    <script src="js/vue-resource.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                loading: false,
                query: '',
                users: []
            },
            watch: {
                query: function(newVal, oldVal){
                    if(typeof(newVal) !== 'undefined'){
                        this.searchUser(newVal);
                    }
                }
            },
            methods: {
                searchUser: function(input){
                    this.loading = true;
                    this.$http.get('/api/users?q=' + input ).then((response) => {
                        this.loading = false;
                        this.users = response.data;
                    }, (response) => {
                      // error callback
                    });
                }
            }
        });
    </script>
    </body>
</html>
