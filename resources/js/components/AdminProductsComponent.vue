<template>
    <div id="AdminProductsComponent" class="container text-center">
       <router-link to="/admin" class="btn btn-secondary  btn-lg btn-block"> <i class="fas fa-arrow-circle-left"></i> Admin Panel</router-link> 
       <a href="#addProductCollapse" data-toggle="collapse" aria-expanded="false" role="button" aria-controls="addProductCollapse" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-plus"></i> Add Product</a>
       <div class="collapse" id="addProductCollapse">
            <product-cu-component></product-cu-component>
        </div>
       <products-list-component></products-list-component>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
