<template>
    <div id="AdminUsersComponent" class="container text-center">
       <router-link to="/admin" class="btn btn-secondary  btn-lg btn-block"> <i class="fas fa-arrow-circle-left"></i> Admin Panel</router-link> 
       <a href="#addUserCollapse" data-toggle="collapse" aria-expanded="false" role="button" aria-controls="addUserCollapse" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-plus"></i> Add Product</a>
       <div class="collapse" id="addUserCollapse">
            <user-cu-component></user-cu-component>
        </div>
       <users-list-component></users-list-component>
    </div>
</template>
 
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
