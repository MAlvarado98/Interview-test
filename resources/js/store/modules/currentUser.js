import axios from 'axios';

const state = {
    user: {}
};
const getters = {};
const actions = {
    getUser({commit}) {
        axios.get("/api/users/current").
        then( response => {
            commit('setUser', response.data);
        });
    },
    loginUser( {}, user ){
        axios.post("/api/users/login", {
            email: user.email,
            password: user.password
        })
        .then(response => {
            if(response.data.token){
                localStorage.setItem(
                    "workoutshop_token",
                    response.data.token
                )

                window.location.replace("/");
            }
            if(response.data.user){
                commit('setUser', response.data);
            }
        })
    },
    logoutUser( {} ){
        localStorage.removeItem("workoutshop_token");
        window.location.replace("/");
    }
};
const mutations = {
    setUser(state, data){
        state.user = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}