<template>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form @submit.prevent="">
                <div class="form-group">
                    <label for="fullNameInput">Full name</label>
                    <input v-model="userEdit.name" type="text" class="form-control" id="fullNameInput" placeholder="Full user name">
                </div>
                <div class="form-group">
                    <label for="emailInput">Email</label>
                    <input v-model="userEdit.email" type="email" class="form-control" id="emailInput" placeholder="example@direction.com">
                </div>
                <div v-if="editingOwn!=1" class="form-group">
                    <label for="roleSelect">Role</label>
                    <select v-model="userEdit.role" class="form-control" id="roleSelect">
                        <option value="1">Common user</option>
                        <option value="2">Administrator</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="passwordInput">Password</label>
                    <input v-model="userEdit.password" type="password" class="form-control" id="passwordInput">
                </div>
                <div class="form-group">
                    <label for="passwordInput2">Confirm password</label>
                    <input v-model="userEdit.password2" type="password" class="form-control" id="passwordInput2">
                </div>
                <button v-if="operation=='create'" @click="createUser" type="submit" class="btn btn-success btn-lg btn-block">Confirm</button>
                <template v-else>
                    <button @click="updateUser" type="submit" class="btn btn-success btn-lg btn-block">Update</button>
                </template>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    import { mapState, mapMutations, mapActions } from 'vuex';

    export default {
        beforeDestroy(){
            this.clearUser();
        },
        data: function () {
            return {
                editingOwn: 0
            }
        },
        computed: {
            ...mapState('currentUser',[
                'userEdit',
                'operation'
            ])
        },
        methods: {
            ...mapMutations('currentUser',[
                'CREATE_USER',
                'UPDATE_USER',
                'CLEAR_EDIT_USER',
                'CHANGE_OPERATION_STATE',
                'POPULATE_UPDATE_CURRENT_USER',
                'GET_USER',
                'UPDATE_CURRENT_USER'
            ]),
            ...mapActions('currentUser',[
                'populateCurrentUserForUpdate'
            ]),
            createUser(){
                this.CREATE_USER(this.userEdit);
            },
            updateUser(){
                if(this.editingOwn != 1)
                    this.UPDATE_USER(this.userEdit);
                else
                    this.UPDATE_CURRENT_USER(this.userEdit);
            },
            clearUser(){
                this.CLEAR_EDIT_USER();
            },
            changeOperationState(operation){
                this.CHANGE_OPERATION_STATE(operation);
            },
            populateForEdit(){
                this.populateCurrentUserForUpdate();
            },
            getUser(){
                this.GET_USER();
            }
        },
        created(){
            if(this.$route.path=="/editUser"){
                this.editingOwn = 1;
                this.changeOperationState('edit');
                this.populateForEdit();
            }
        }
    }
</script>
