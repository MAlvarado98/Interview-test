<template>
    <div class="container" id="RegisterComponent">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form @submit.prevent="register" class="form-signin">
                    <h1 class="h3 mb-3 font-weight-normal text-center">Register</h1>
                    <div class="form-group">
                        <label for="nameInput">Full Name</label>
                        <input v-model="user.name" type="text" class="form-control" id="nameInput" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="emailInput">Email address</label>
                        <input v-model="user.email" type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input v-model="user.password" type="password" class="form-control" id="passwordInput">
                    </div>
                    <div class="form-group">
                        <label for="password2Input">Confirm Password</label>
                        <input v-model="user.password2" type="password" class="form-control" id="password2Input">
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Confirm</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default {
        data: () => ({
            user: {
                name: "",
                email: "",
                password: "",
                pasword2: ""
            }
        }),
        methods:{
            ...mapMutations('currentUser',[
                'REGISTER_USER'
            ]),
            register(){
                this.REGISTER_USER(this.user);
            }
        },
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                window.location.replace("/");
            }
        }
    }
</script>
