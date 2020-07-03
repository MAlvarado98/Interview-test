<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';
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
