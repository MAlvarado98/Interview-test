import axios from 'axios';
import router from '../../router';

function populateUserEdit(usr){
    state.userEdit.id = usr.id;
    state.userEdit.name = usr.name;
    state.userEdit.email = usr.email;
    state.userEdit.role = usr.role;
}

function clearUserEdit(){
    state.userEdit.id = "";
    state.userEdit.name = "";
    state.userEdit.role = "";
    state.userEdit.email = "";
    state.userEdit.password = "";
    state.userEdit.password2 = "";
}

const state = {
    user: {},
    message: "",
    users: {},
    userEdit: {
        id : "",
        name : "",
        role : "",
        email : "",
        password : "",
        password2 : ""
    },
    operation: "create"
};
const getters = {
    getUserRole: state => {
        return state.user.role;
    }
};
const mutations = {
    //Get current user mutation
    GET_USER: (state) => {
        axios.get("/api/users/current").
        then( response => {
            state.user = response.data;
        })
    },
    //Login user and change user state
    LOGIN_USER: (state, user) => {
        axios.post("/api/users/login", {
            email: user.email,
            password: user.password
        })
        .then(response => {
            if(response.data.token){
                localStorage.setItem(
                    "workoutshop_token",
                    response.data.token
                );
                state.user = response.data.user;
                router.push("/");
            }
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
    },
    //Logout user and change user state
    LOGOUT_USER: (state) => {
        localStorage.removeItem("workoutshop_token");
        state.user = {};
        router.push("/login");
    },
    //Register user and change user state
    REGISTER_USER: (state, user) => {
        axios.post("/api/users/register", {
            name: user.name,
            email: user.email,
            password: user.password,
            password2: user.password2
        }).
        then(response => {
            if(response.data.token){
                localStorage.setItem(
                    "workoutshop_token",
                    response.data.token
                );
                state.user = response.data.user;
                window.location.href = "/";
            }
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
        });
    },
    //Gets all users OIUIA and current user role is administrator
    GET_USERS: (state) => {
        axios.get('/api/users')
        .then( response => {
            state.users = response.data.users;
        })
        .catch( error => {

        })
    },
    //Helper to populate form
    POPULATE_FOR_EDIT: (state, user) => {
        clearUserEdit();
        let index = state.users.findIndex( item => item.id == user.id);
        var usr = state.users[index];
        populateUserEdit(usr);
        if(!$('#addUserCollapse').hasClass('show'))
            $('#addUserCollapse').toggleClass("show");
        state.operation = "edit";
    },
    //Helper to populate modal
    POPULATE_FOR_DELETE: (state, user) => {
        clearUserEdit();
        let index = state.users.findIndex( item => item.id == user.id);
        var usr = state.users[index];
        populateUserEdit(usr);
        if($('#addUserCollapse').hasClass('show'))
            $('#addUserCollapse').toggleClass("show");
    },
    //Helper to clear populated user
    CLEAR_EDIT_USER: () => {
        clearUserEdit();
    },
    //Allows to create an user of any role OIUIA and current user role is administartor
    CREATE_USER: (state, user) => {
        axios.post("/api/users", {
            name: user.name,
            role: user.role,
            email: user.email,
            password: user.password,
            password2: user.password2
        })
        .then( response => {
            state.users.push(response.data.user);
            clearUserEdit();
            $('#addUserCollapse').toggleClass("show");
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
    //Allows to update an user of any role OIUIA and current user role is administartor
    UPDATE_USER: (state, user) => {
        axios.put("/api/users/user/"+user.id, {
            name: user.name,
            role: user.role,
            email: user.email,
            password: user.password,
            password2: user.password2
        })
        .then( response => {
            let usr = response.data.result;
            let index = state.users.findIndex( item => item.id == user.id);
            state.users[index].name = user.name;
            state.users[index].email = user.email;
            state.users[index].role = user.role;
            clearUserEdit();
            $('#addUserCollapse').toggleClass("show");
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
    //Allows to create an user if its role isn't administrator OIUIA and current user role is administartor
    DELETE_USER: (state, id) => {
        axios.delete("/api/users/user/"+id)
        .then( response => {
            let index = state.users.findIndex( item => item.id == state.userEdit.id);
            state.users.splice(index, 1);
            clearUserEdit();
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
    //Allows current user to update its credentials
    UPDATE_CURRENT_USER: (state, user) => {
        axios.put("/api/users/user/"+user.id, {
            name: user.name,
            role: user.role,
            email: user.email,
            password: user.password,
            password2: user.password2
        })
        .then( response => {
            clearUserEdit();
            localStorage.removeItem("workoutshop_token");
            window.location.href = '/login';
            Vue.toasted.success(response.data.message+" Please login again.",{
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
    //Allows current user to delete its uesr
    DELETE_CURRENT_USER: (state, user) => {
        axios.delete("/api/users/user/"+user.id)
        .then( response => {
            clearUserEdit();
            localStorage.removeItem("workoutshop_token");
            window.location.href = '/';
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
            Vue.toasted.error(error.response.data.message+" Please login again.",{
                action : {
                    text : 'close',
                    onClick : (e, toastObject) => {
                        toastObject.goAway(0);
                    }
                }
            }).goAway(2000);
        })
    },
    //Change operation state
    CHANGE_OPERATION_STATE: (state, operation) =>{
        state.operation = operation;
    },
    //Helper to populate with current user
    POPULATE_UPDATE_CURRENT_USER: (state) =>{
        populateUserEdit(state.user);
    }
};
const actions = {
    populateCurrentUserForUpdate({commit}, quantity){
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                commit('POPULATE_UPDATE_CURRENT_USER');
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