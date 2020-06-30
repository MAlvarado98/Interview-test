<template>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Full name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Full user name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="example@direction.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>Common user</option>
                    <option>Administrator</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm password</label>
                    <input type="password" class="form-control" id="confirmPassword">
                </div>
                <button type="button" class="btn btn-success btn-lg btn-block">Confirm</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
