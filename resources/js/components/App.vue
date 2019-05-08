    <template>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <router-link :to="{name: 'home'}" class="navbar-brand">For Webscope Code Challenge</router-link>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                            <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>

                            <li class="nav-link" v-if="isLoggedIn" @click="logout">Logout</li>
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="py-4">
                <router-view @loggedIn="change"></router-view>
            </main>
        </div>
    </template>

    <script>
    export default {
        data() {
            return {
                name: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('wstodo.jwt') != null
            }
        },
        mounted() {
            this.setDefaults()
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('wstodo.user'))
                    this.name = user.name
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('wstodo.jwt') != null
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('wstodo.jwt')
                localStorage.removeItem('wstodo.user')
                this.change()
                this.$router.push({path: '/'})
            }
        }
    }
    </script>