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
                    <li class="list-group-item d-flex justify-content-between">
                    <span>Total (MXN)</span>
                    <strong>${{getTotal}}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                    Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>
                </div>
                </div>

                <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                    <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                    </div>
                </div>
                </div>

                <div class="mb-3">
                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>

                <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
                </div>

                <div class="mb-3">
                <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div>

                <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Country</label>
                    <select class="custom-select d-block w-100" id="country" required>
                    <option value="">Choose...</option>
                    <option>United States</option>
                    </select>
                    <div class="invalid-feedback">
                    Please select a valid country.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="state">State</label>
                    <select class="custom-select d-block w-100" id="state" required>
                    <option value="">Choose...</option>
                    <option>California</option>
                    </select>
                    <div class="invalid-feedback">
                    Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" placeholder="" required>
                    <div class="invalid-feedback">
                    Zip code required.
                    </div>
                </div>
                </div>
                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="same-address">
                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                </div>
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="save-info">
                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                    <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                    <label class="custom-control-label" for="paypal">PayPal</label>
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                    Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                    <div class="invalid-feedback">
                    Credit card number is required
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                    <div class="invalid-feedback">
                    Expiration date required
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                    <div class="invalid-feedback">
                    Security code required
                    </div>
                </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Buy</button>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations, mapGetters } from 'vuex';

    export default {
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
                'CALCULATE_TOTAL'
            ]),
            getCart(){
                this.GET_CART();
                this.CALCULATE_TOTAL();
            },
            deleteFromCart(id){
                this.DELETE_FROM_CART(id);
                this.CALCULATE_TOTAL();
            },
            editCartItem(id, value){
                let payload = {
                    id: id,
                    value: value
                };
                this.EDIT_CART_ITEM(payload);
                this.CALCULATE_TOTAL();
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
