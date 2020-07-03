<template>
    <div class="mt-4">
        <table class="table">
            <thead class="bg-primary">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(usr, index) in users" v-bind:key="index">
                    <th scope="row">{{usr.id}}</th>
                    <td>{{usr.name}}</td>
                    <td>{{usr.email}}</td>
                    <td>{{usr.role==1?'Common user':'Administartor'}}</td>
                    <td><a class="btn btn-primary" @click="populateForEdit(usr)" href="#" role="button"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-secondary" @click="populateForDelete(usr)" href="#" role="button"><i class="fas fa-trash"></i></a></td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalTitleLabel">Delete {{userEdit.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="deleteUser(userEdit.id)" type="button" class="btn btn-primary">Delete</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default {
        computed: {
            ...mapState('currentUser',[
                'users',
                'userEdit'
            ])
        },
        methods:{
            ...mapMutations('currentUser',[
                'GET_USERS',
                'POPULATE_FOR_DELETE',
                'POPULATE_FOR_EDIT',
                'DELETE_USER'
            ]),
            getUsers(){
                this.GET_USERS();
            },
            populateForEdit(user){
                this.POPULATE_FOR_EDIT(user);
            },
            populateForDelete(id){
                this.POPULATE_FOR_DELETE(id);
                $("#deleteModal").modal();
            },
            deleteUser(id){
                this.DELETE_USER(id);
                $("#deleteModal").modal('hide');
            }
        },
        created(){
            this.getUsers();
        }
    }
</script>
