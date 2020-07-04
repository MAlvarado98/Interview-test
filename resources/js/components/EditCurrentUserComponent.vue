<template>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Edit your user</h1>
        </div>
        <div class="col-md-12">
            <user-cu-component></user-cu-component>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <button @click="openDeleteModal" type="submit" class="btn btn-secondary btn-lg btn-block">Delete my user</button>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete my user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you shure you want to delete your user? You won't be asked again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="deleteUser" type="button" class="btn btn-primary">delete</button>
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
                'user'
            ])
        },
        methods: {
            ...mapMutations('currentUser',[
                'DELETE_CURRENT_USER'
            ]),
            deleteUser(){
                this.DELETE_CURRENT_USER(this.user);
            },
            openDeleteModal(){
                $("#deleteModal").modal();
            }
        }
    }
</script>
