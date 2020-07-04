<template>
    <div class="container" id="login-component">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <form @submit.prevent="login" class="form-signin">
                    <img class="mb-4 login-icon" src="/img/logo.png">
                    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" v-model="user.email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" v-model="user.password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox mb-3">
                        <label>
                        <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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
                email: "",
                password: ""
            }
        }),
        computed:{
            ...mapState('currentUser',[
                'message'
            ])
        },
        methods: {
            ...mapMutations('currentUser',[
                'LOGIN_USER'
            ]),
            login(){
                this.LOGIN_USER(this.user);
            }
        },
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                this.$router.push("/");
            }
        }
    }   
</script>
