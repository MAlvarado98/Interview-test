<template>
    <div id="AdminUsersComponent" class="container text-center">
       <router-link to="/admin" class="btn btn-secondary  btn-lg btn-block"> <i class="fas fa-arrow-circle-left"></i> Admin Panel</router-link> 
       <a href="#addUserCollapse" @click="changeOperationState('create')" data-toggle="collapse" aria-expanded="false" role="button" aria-controls="addUserCollapse" class="btn btn-primary btn-lg btn-block"> <i class="fas fa-plus"></i> Add User</a>
       <div class="collapse" id="addUserCollapse">
            <user-cu-component></user-cu-component>
        </div>
       <users-list-component></users-list-component>
    </div>
</template>
 
<script>
    import { mapMutations } from 'vuex';
    export default {
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                if(this.$store.state.currentUser.user.role != 2){
                    this.$router.push("/");
                }
            }else{
                this.$router.push("/login");
            }
        },
        methods:{
            ...mapMutations('currentUser', [
                'CHANGE_OPERATION_STATE'
            ]),
            changeOperationState(op){
                this.CHANGE_OPERATION_STATE(op);
            }
        }
    }
</script>
