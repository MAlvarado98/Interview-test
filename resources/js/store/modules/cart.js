import axios from 'axios';

function getIndex(array, id){
    return array.findIndex( item => item.id == id);
}

const state = {
    cart: {},
    cartProduct: {},
    total: 0
};
const getters = {
    getTotal: (state) => {
        var total = 0;
        for(var i = 0 ; i < state.cart.length; i++){
            total += state.cart[i].quantity * state.cart[i].price;
        }
        return total.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    getCountProducts: (state) => {
        var count = 0;
        for(var i = 0 ; i < state.cart.length; i++){
            count += state.cart[i].quantity;
        }
        return count;
    }
};
const mutations = {
    GET_CART: (state) => {
        axios.get('/api/cart')
        .then( response =>{
            state.cart = response.data;
        }).catch(error => {

        })
    },
    DELETE_FROM_CART: (state, id) => {
        axios.delete('/api/cart/'+id)
        .then( response => {
            let index = state.cart.findIndex( item => item.id == id);
            state.cart.splice(index, 1);
        })
        .catch( error => {

        })
    },
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
        })
        .catch( error => {
            alert(error.response.data.message);
        });
    },
    CALCULATE_TOTAL: (state) => {
        var total = 0;
        for(var i = 0 ; i < state.cart.length; i++){
            total += state.cart[i].quantity * state.cart[i].price;
        }
        state.total = total;
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