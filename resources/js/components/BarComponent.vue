<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <router-link class="navbar-brand" to="/"><img class="paquito" src="/img/logo.png" alt="WORKOUTSHOP"></router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" to="/products/men"><i class="fas fa-tshirt"></i> Men</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" to="/products/women"><i class="fas fa-tshirt"></i> Women</router-link>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Product Type
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <router-link class="dropdown-item" to="/products/suplements"> <i class="fas fa-drumstick-bite"></i> Suplements</router-link>
                        <router-link class="dropdown-item" to="/products/gym-equipement"> <i class="fas fa-dumbbell"></i> GYM Equipment</router-link>
                        <router-link class="dropdown-item" to="/products/accesories"> <i class="fas fa-mitten"></i> Accesories</router-link>
                    </div>
                </li>
                </ul>
                <div class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li v-if="user.name" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Hi {{ user.name.split(" ")[0] }}!
                            </a>
                            <div class="dropdown-menu" aria-labelledby="userDropDown">
                                <router-link class="dropdown-item" to="/editUser"> <i class="fas fa-edit"></i> Edit my account</router-link>
                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/cart"><i class="fas fa-shopping-cart"></i> My Cart</router-link>
                        </li>
                        <template v-if="user.name">
                            <li v-if="user.role == 2" class="nav-item">
                                <router-link class="nav-link" to="/admin"> <i class="fas fa-cog"></i> Admin <span class="sr-only"></span></router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" @click="logoutUser"> <i class="fas fa-sign-out-alt"></i> Logout <span class="sr-only"></span></a>
                            </li>
                        </template>
                        <template v-else>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/login"> <i class="fas fa-sign-in-alt"></i> Login <span class="sr-only"></span></router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/register"> <i class="fas fa-user-plus"></i> Register</router-link>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';
    
    export default {
        methods: {
            ...mapMutations('currentUser',[
                'LOGOUT_USER',
                'GET_USER'
            ]),
            logoutUser(){
                this.LOGOUT_USER();
            },
            getUser(){
                this.GET_USER();
            }
        },
        computed: {
            ...mapState('currentUser',[
                'user'
            ])
        },
        created(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("workoutshop_token");
                this.getUser();
            }
        }
    }
</script>
