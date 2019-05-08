<template>
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Add Task</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" v-model="name" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Description</label>
                                    <div class="col-md-6">
                                        <input id="description" type="text" class="form-control" v-model="description" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Expect Time</label>
                                    <div class="col-md-6">
                                        <datetime format="YYYY-MM-DD H:i:s" v-model="except_finish_time" required></datetime>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import datetime from 'vuejs-datetimepicker';

    export default {
        components: { datetime },
        props : ['nextUrl'],
        data(){
            return {
                name : "",
                description : "",
                except_finish_time : 0,
                user_id : 0,
            }
        },

        beforeMount() {
            this.user = JSON.parse(localStorage.getItem('wstodo.user'))

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('wstodo.jwt')
        },

        methods : {
            handleSubmit(e) {
                e.preventDefault()

                let name = this.name
                let description = this.description
                let except_finish_time = this.except_finish_time
                let user_id = this.user.id
                axios.post('api/todos', {name, user_id, description, except_finish_time}).then(response => {
                    let data = response.data
                    if (localStorage.getItem('wstodo.jwt') != null) {
                        let nextUrl = this.$route.params.nextUrl
                        this.$router.push((nextUrl != null ? nextUrl : '/'))
                    }
                })
            }
        }
    }
</script>