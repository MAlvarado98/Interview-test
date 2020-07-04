<template>
    <div class="container">
        <h1 class="text-center"><i class="fas fa-shopping-cart"></i> Cart</h1>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{getCountProducts}}</span>
                </h4>
                <ul class="list-group mb-3">
                    <li v-for="(item, index) in cart" v-bind:key="index" class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><span class="badge badge-secondary badge-pill">{{item.quantity}}</span> {{item.name}}</h6>
                            <a @click="editCartItem(item.id,-1)" href="#"><i class="fas fa-minus-circle"></i></a>
                            <a @click="editCartItem(item.id,1)" href="#"><i class="fas fa-plus-circle"></i></a>
                            <a @click="deleteFromCart(item.id)" href="#"><i class="fas fa-trash"></i></a>
                        </div>
                        <span class="text-muted">${{(item.price*item.quantity).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</span>
                    </li>
                    <li v-if="cart.length==0" class="list-group-item d-flex justify-content-between lh-condensed">
                        <h6 class="my-0">Your cart is empty</h6>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (MXN)</span>
                        <strong>${{getTotal}}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form @submit.prevent="" class="needs-validation">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input v-model="first" type="text" class="form-control" id="firstName" placeholder="Your first name" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input v-model="last" type="text" class="form-control" id="lastName" placeholder="Your last name" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input v-model="email" type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input v-model="address" type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input v-model="address2" type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="country">Country</label>
                            <country-select class="custom-select d-block w-100" v-model="country" :country="country" topCountry="US" />
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <region-select class="custom-select d-block w-100" v-model="region" :country="country" :region="region" />
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">City</label>
                            <input v-model="city" type="text" class="form-control" id="city" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input v-model="zip" type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="col-md-4 mb-3">
                            <label for="country">Payment</label>
                            <select v-model="payMethod" class="custom-select d-block w-100" id="country" required>
                                <option value="CC">Credit Card</option>
                                <option value="DC">Debit Card</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid pay method.
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input v-model="cardName" type="text" class="form-control" id="cc-name" placeholder="Name on card" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number (Only numbers)</label>
                            <input v-model="creditCardNumber" type="text" class="form-control" id="cc-number" placeholder="XXXXXXXXXXXXXXXX" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input v-model="expiration" type="text" class="form-control" id="cc-expiration" placeholder="MM/YYYY" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input v-model="cvv" type="text" class="form-control" id="cc-cvv" placeholder="XXX" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button @click="submitCart(cart)" class="btn btn-primary btn-lg btn-block" type="submit">Buy</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState, mapMutations, mapGetters } from 'vuex';
    
    export default {
        data: () => ({
            first: '',
            last: '',
            email: '',
            address: '',
            address2: '',
            country: '',
            region: '',
            city: '',
            zip: '',
            payMethod: '',
            cardName: '',
            creditCardNumber: '',
            expiration: '',
            cvv: ''
        }),
        computed:{
            ...mapState('cart',[
                'cart',
                'total'
            ]),
            ...mapGetters('cart',[
                'getTotal',
                'getCountProducts'
            ])
        },
        methods:{
            ...mapMutations('cart',[
                'GET_CART',
                'DELETE_FROM_CART',
                'EDIT_CART_ITEM',
                'CALCULATE_TOTAL',
                'SUBMIT_CART'
            ]),
            getCart(){
                this.GET_CART();
            },
            deleteFromCart(id){
                this.DELETE_FROM_CART(id);
            },
            editCartItem(id, value){
                let payload = {
                    id: id,
                    value: value
                };
                this.EDIT_CART_ITEM(payload);
            },
            submitCart(cart){
                let payload = {
                    information: {
                        first: this.first,
                        last: this.last,
                        email: this.email,
                        address: this.address,
                        address2: this.address2,
                        country: this.country,
                        region: this.region,
                        city: this.city,
                        zip: this.zip,
                        payMethod: this.payMethod,
                        cardName: this.cardName,
                        creditCardNumber: this.creditCardNumber,
                        expiration: this.expiration,
                        cvv: this.cvv
                    },
                    cart: cart
                }
                this.SUBMIT_CART(payload);
                this.$bvToast.toast("hola");
            }
        },
        created(){
            this.getCart();
        },
        beforeCreate(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("workoutshop_token");
            }else{
                this.$router.push("/login");
            }
        }
    }
</script>
