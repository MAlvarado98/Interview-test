import axios from 'axios';
import router from '../../router';


function getIndex(array, id){
    return array.findIndex( item => item.id == id);
}

const state = {
    cart: {},
    cartProduct: {},
    total: 0
};
const getters = {
    //Getter that returns total of amount to pay
    getTotal: (state) => {
        var total = 0;
        for(var i = 0 ; i < state.cart.length; i++){
            total += state.cart[i].quantity * state.cart[i].price;
        }
        return total.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    //Getter that returns the count of products in cart
    getCountProducts: (state) => {
        var count = 0;
        for(var i = 0 ; i < state.cart.length; i++){
            count += state.cart[i].quantity;
        }
        return count;
    }
};
const mutations = {
    //Allows to retrieve items added in cart
    GET_CART: (state) => {
        axios.get('/api/cart')
        .then( response =>{
            state.cart = response.data;
        }).catch(error => {

        })
    },
    //Allows to remove a set of items from cart
    DELETE_FROM_CART: (state, id) => {
        axios.delete('/api/cart/'+id)
        .then( response => {
            let index = state.cart.findIndex( item => item.id == id);
            state.cart.splice(index, 1);
            Vue.toasted.success(response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            }).goAway(2000);
        })
        .catch( error => {
            Vue.toasted.error(error.response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            });
        })
    },
    //Allows to edit one item in cart (add or substract)
    EDIT_CART_ITEM: (state, payload) => {
        axios.put('/api/cart/'+payload.id,{
            quantity: payload.value
        })
        .then( response => {
            let index = getIndex(state.cart, payload.id);
            if(response.data.quantity>0)
                state.cart[index].quantity = response.data.quantity;
            else
                state.cart.splice(index,1);
            Vue.toasted.success(response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            }).goAway(2000);
        })
        .catch( error => {
            Vue.toasted.error(error.response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            });
        });
    },
    // Allows to submit cart
    SUBMIT_CART: (state, payload) => {
        axios.post('/api/cart/checkout/submit',{
            cart : payload.cart,
            information: payload.information
        })
        .then(response => {
            router.push("/");
            Vue.toasted.success(response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            }).goAway(2000);
        })
        .catch(error => {
            Vue.toasted.error(error.response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            });
        })
    }
};
const actions = {
    
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}