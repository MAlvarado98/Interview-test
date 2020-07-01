<template>
    <div>
        <bar-component></bar-component>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        computed:{
            currentUser: {
                get() {
                    return this.$store.state.currentUser.user;
                }
            }
        },
        created() {
            
        }
    }
</script>
