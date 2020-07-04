<template>
    <div id="AdminComponent" class="container text-center">
        <div class="row mt-2">
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <router-link class="admin-component-button" to="/admin/users">
                    <h2>Admin Users</h2>
                    <img src="img/user-icon-img.png" alt="Product Admin Icon">
                </router-link>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-3">
                <router-link class="admin-component-button" to="/admin/products">
                    <h2>Admin Products</h2>
                    <img src="img/product-admin-icon-img.png" alt="Product Admin Icon">
                </router-link>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</template>

<script>
    export default {
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                if(this.$store.state.currentUser.user.role != 2){
                    this.$router.push("/");
                }
            }else{
                this.$router.push("/login");
            }
        }
    }
</script>
