<template>
    <div id="ProductsComponent" class="container">
        <div class="row">
            <div class="col-md-12 mb-1">
                <div v-if="section" class="pricing-header">
                    <h1 class="display-4 mx-auto text-center"> {{section}}</h1>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div id="Products" class="col-md-12">
                            <template v-if="products.length">
                                <div class="row">
                                    <div v-for="(prod, index) in products" v-bind:key="index" class="col-md-3">
                                        <router-link class="card-link" v-bind:to="'/products/'+prod.id+'/'+prod.slug">
                                            <div class="card">
                                                <img v-bind:src="'/img/products/'+prod.id_image" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4>$ {{prod.price}}</h4>
                                                    <p class="card-text">{{prod.name}}</p>
                                                </div>
                                            </div>
                                        </router-link>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <h1 class="text-center">Ups! It seems there are no products yet.</h1>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default {
        data: () =>({
            section: ""
        }),
        computed:{
            ...mapState('product',[
                'products'
            ])
        },
        methods: {
            ...mapMutations('product',[
                'GET_PRODUCTS',
                'GET_ALL_PRODUCTS'
            ]),
            getProducts(category){
                this.GET_PRODUCTS(category);
            },
            getAllProducts(){
                this.GET_ALL_PRODUCTS();
            }
        },
        created() {
            var category = this.$route.params.category+"";
            if(category !== "undefined"){
                this.section = (category.charAt(0).toUpperCase() + category.slice(1)).replace('-',' ');
                this.getProducts(category);
            }else{
                this.getAllProducts();
            }
        },
        watch:{
            $route (to, from){
                var category = this.$route.params.category+"";
                if(category !== "undefined"){
                    this.section = (category.charAt(0).toUpperCase() + category.slice(1)).replace('-',' ');
                    this.getProducts(category);
                }else{
                    this.section = "";
                    this.getAllProducts();
                }
            }
        } 
    }
</script>
