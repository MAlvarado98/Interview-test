<template>
    <div id="AdminProductsComponent" class="container text-center">
       <router-link to="/admin" class="btn btn-secondary  btn-lg btn-block"> <i class="fas fa-arrow-circle-left"></i> Admin Panel</router-link> 
       <a href="#addProductCollapse" @click="changeOperation" data-toggle="collapse" aria-expanded="false" role="button" aria-controls="addProductCollapse" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-plus"></i> Add Product</a>
       <div class="collapse" id="addProductCollapse">
            <product-cu-component></product-cu-component>
        </div>
       <products-list-component></products-list-component>
    </div>
</template>

<script>
    import { mapMutations } from 'vuex';

    export default {
        methods:{
            ...mapMutations('product',[
                'CHANGE_OPERATION_CREATE'
            ]),
            changeOperation(){
                this.CHANGE_OPERATION_CREATE();
            }
        },
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
