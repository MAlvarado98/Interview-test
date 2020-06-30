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
                    <router-link class="dropdown-item" to="/products/clothes"> <i class="fas fa-tshirt"></i> Clothes</router-link>
                    <router-link class="dropdown-item" to="/products/suplements"> <i class="fas fa-drumstick-bite"></i> Suplements</router-link>
                    <router-link class="dropdown-item" to="/products/gym-equipement"> <i class="fas fa-dumbbell"></i> GYM Equipment</router-link>
                    <router-link class="dropdown-item" to="/products/accesories"> <i class="fas fa-mitten"></i> Accesories</router-link>
                    </div>
                </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/cart"><i class="fas fa-shopping-cart"></i> My Cart</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login"> <i class="fas fa-sign-in-alt"></i> Login <span class="sr-only"></span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register"> <i class="fas fa-user-plus"></i> Register</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin"> <i class="fas fa-cog"></i> Admin <span class="sr-only"></span></router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/logout"> <i class="fas fa-sign-out-alt"></i> Logout <span class="sr-only"></span></router-link>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
