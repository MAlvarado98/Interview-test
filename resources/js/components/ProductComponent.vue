<template>
    <div class="container" id="ProductComponent">
        <a @click="goBack" class="float-left" href="#" type="button"><h2><i class="fas fa-arrow-circle-left"></i></h2></a>
        <h1 class="text-center">{{product.name}}</h1>
        <div class="row">
            <div class="col-md-8">
                <img class="product-image" v-bind:src="'/img/products/'+product.image" alt="">
            </div>
            <div class="col-md-4">
                <form action="">
                    <h3 class="product-price">Price: ${{product.price}}</h3>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quantity</label>
                        <input @change="setQuantityMethod(quantity)" v-model="quantity" type="number" min="1" v-bind:max="product.stock" class="form-control" id="exampleInputPassword1">
                        <label for="exampleInputPassword1">{{product.stock}} available.</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Color</label>
                        <select class="form-control" id="exampleFormControlSelect1" disabled>
                            <option>red</option>
                            <option>blue</option>
                            <option>yellow</option>
                            <option>green</option>
                            <option>white</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Size</label>
                        <select class="form-control" id="exampleFormControlSelect1" disabled>
                            <option>XS</option>
                            <option>S</option>
                            <option>M</option>
                            <option>L</option>
                            <option>XL</option>
                            <option>XXL</option>
                        </select>
                    </div>
                    <h3 class="product-price mt-5">Total: ${{total}}</h3>
                    <button v-if="product.status==1" @click="addProductTotCart" type="button" class="btn btn-success btn-lg btn-block"> <i class="fas fa-cart-plus"></i> Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="row">
            <h3 class="col-md-12">Product description</h3>
            <p class="col-md-12"> 
                {{product.description}}
            </p>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations, mapGetters, mapActions } from 'vuex';

    export default {
        data (){
            return{
                'prevRoute' : "",
                'quantity' : 1
            }
        },
        computed:{
            ...mapState('product',[
                'product',
                'total'
            ])
        },
        methods:{
            ...mapMutations('product',[
                'GET_PRODUCT',
                'SET_QUANTITY',
                'ADD_PRODUCT_TO_CART'
            ]),
            ...mapActions('product', [
                'setQuantity'
            ]),
            getProduct(slug,id){
                this.GET_PRODUCT(slug,id)
            },
            goBack(){
                this.$router.push(this.prevRoute);
            },
            setQuantityMethod(quantity){
                this.setQuantity(quantity);
            },
            addProductTotCart(){
                var q = this.quantity;
                this.ADD_PRODUCT_TO_CART(this.product,q);
            }
        },
        created(){
            this.getProduct(this.$route.params.slug,this.$route.params.id,);
            this.setQuantityMethod(this.quantity);
        },
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.prevRoute = from;
            })
        }
    }
</script>
