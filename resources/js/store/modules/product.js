import axios from 'axios';
import router from '../../router';

function clearProduct(){
    state.product.id = "";
    state.product.name = "";
    state.product.image = "";
    state.product.description = "";
    state.product.price = "";
    state.product.slug = "";
    state.product.status = "";
    state.product.stock = "";
    state.product.type = "";
}

const state = {
    product: {
        id: "",
        name: "",
        image: "",
        description: "",
        price: "",
        slug: "",
        status: "",
        stock: "",
        type: ""
    },
    products: {},
    message: "",
    total: "",
    quantity: 0,
    operation: "create"
};
const getters = {
};
const mutations = {
    //Allows to create a product only if the user is administrator(OIUIA)
    CREATE_PRODUCT: (state, product) => {
        axios.post("/api/products", {
            name: product.name,
            image: product.image,
            description: product.description,
            price: product.price,
            stock: product.stock,
            type: product.type
        })
        .then( response => {
            state.products.push(response.data.product);
            clearProduct();
            $('#addProductCollapse').toggleClass("show");
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
    //Allows to update a product OIUIA
    UPDATE_PRODUCT: (state, product) => {
        axios.put("/api/products/"+product.id, {
            name: product.name,
            image: product.image,
            description: product.description,
            price: product.price,
            stock: product.stock,
            type: product.type,
            status: product.status
        })
        .then( response => {
            let prod = response.data.result;
            let index = state.products.findIndex( item => item.id == prod.id);
            state.products[index].id = prod.id;
            state.products[index].name = prod.name;
            state.products[index].image = "";
            state.products[index].description = prod.description;
            state.products[index].price = prod.price;
            state.products[index].slug = prod.slug;
            state.products[index].status = prod.status;
            state.products[index].stock = prod.stock;
            state.products[index].type = prod.type;
            clearProduct();
            $('#addProductCollapse').toggleClass("show");
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
    //Deletes a product OIUIA
    DELETE_PRODUCT : (state, id) => {
        axios.delete("/api/products/"+id)
        .then( response => {
            var prod = state.product;
            let index = state.products.findIndex( item => item.id == prod.id);
            state.products.splice(index, 1);
            clearProduct();
            Vue.toasted.show(response.data.message,{
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
    //Gets all products
    GET_ALL_PRODUCTS : (state) => {
        axios.get("/api/products")
        .then( response => {
            state.products = response.data;
        })
        .catch( error => {
            
        })
    },
    //Gets products by category
    GET_PRODUCTS : (state, category) => {
        axios.get("/api/products/"+category)
        .then( response => {
            state.products = response.data;
        })
        .catch( error => {
            
        })
    },
    //Gets a single product
    GET_PRODUCT : (state, slug , id) => {
        axios.get("/api/products/"+id+"/"+slug)
        .then( response => {
            let prod = response.data;
            state.product.id = prod.id;
            state.product.name = prod.name;
            state.product.image = prod.id_image;
            state.product.description = prod.description;
            state.product.type = prod.type;
            state.product.stock = prod.stock;
            state.product.price = prod.price;
            state.product.status = prod.status;
        })
        .catch( error => {
            
        })
    },
    //Helper mutation to populate product variable for edition
    POPULATE_FOR_EDIT: (state, id) => {
        clearProduct();
        let index = state.products.findIndex( item => item.id == id);
        var prod = state.products[index];
        state.product.id = prod.id;
        state.product.name = prod.name;
        state.product.description = prod.description;
        state.product.type = prod.type;
        state.product.stock = prod.stock;
        state.product.price = prod.price;
        state.product.status = prod.status;
        if(!$('#addProductCollapse').hasClass('show'))
            $('#addProductCollapse').toggleClass("show");
        state.operation = "edit";
    },
    //Helper mutation to populate product variable for deletion
    POPULATE_FOR_DELETE: (state, id) => {
        clearProduct();
        let index = state.products.findIndex( item => item.id == id);
        var prod = state.products[index];
        state.product.id = prod.id;
        state.product.name = prod.name;
        state.product.description = prod.description;
        state.product.type = prod.type;
        state.product.stock = prod.stock;
        state.product.price = prod.price;
        state.product.status = prod.status;
        if($('#addProductCollapse').hasClass('show'))
            $('#addProductCollapse').toggleClass("show");
    },
    //Helper to change operation
    CHANGE_OPERATION_CREATE: (state) => {
        state.operation = "create";
        clearProduct();
    },
    //Helper to clear populated product
    CLEAR_PRODUCT: () => {
        clearProduct();
    },
    //Sets quantity
    SET_QUANTITY: (state, quantity)  => {
        state.quantity = quantity;
        state.total = (quantity * state.product.price).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    //Adds product to cart Only if user is loged in
    ADD_PRODUCT_TO_CART: (state, product) => {
        axios.post("/api/cart", {
            product_id: product.id,
            quantity: state.quantity
        })
        .then( response => {
            Vue.toasted.success(response.data.message,{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            }).goAway(2000);
            router.go(-1);
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
    }
};
const actions = {
    //Async method to set quantity state, because of database time response
    setQuantity({commit}, quantity){
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                commit('SET_QUANTITY',quantity);
                resolve();
            },800)
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}