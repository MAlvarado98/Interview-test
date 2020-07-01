<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                this.$store.dispatch('currentUser/getUser');
                if(this.$store.state.currentUser.role == 2){
                    
                }else{
                    window.location.replace("/");
                }
            }else{
                window.location.replace("/login");
            }
        },
        computed: {
            currentUser: {
                get() {
                    return this.$store.state.currentUser.user;
                }
            }
        }
    }
</script>
