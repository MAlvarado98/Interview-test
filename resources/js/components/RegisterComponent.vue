<template>
    <div class="container" id="login-component">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form class="form-signin">
                    <h1 class="h3 mb-3 font-weight-normal text-center">Register</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group text-center">
                        <a href="#">Read Privacy terms</a>
                        <div class="checkbox mb-3">
                            <label>
                            <input type="checkbox" value="remember-me"> I accept privacy terms
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Confirm</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</template>

<script>
    export default {
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                window.location.replace("/");
            }
        }
    }
</script>
