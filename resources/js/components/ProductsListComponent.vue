<template>
    <div class="mt-4">
        <table class="table">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(prod, index) in products" v-bind:key="index">
                    <th scope="row">{{prod.id}}</th>
                    <td>{{prod.name}}</td>
                    <td>{{prod.type}}</td>
                    <td>{{prod.stock}}</td>
                    <td><a class="btn btn-primary" @click="populateForEdit(prod.id)" href="#" role="button"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-secondary" @click="populateForDelete(prod.id)" role="button"><i class="fas fa-trash"></i></a></td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalTitleLabel">Delete {{product.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="deleteProduct(product.id)" type="button" class="btn btn-primary">Delete</button>
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
            ...mapState('product',[
                'products',
                'product'
            ])
        },
        methods: {
            ...mapMutations('product',[
                'GET_ALL_PRODUCTS',
                'POPULATE_FOR_EDIT',
                'POPULATE_FOR_DELETE',
                'DELETE_PRODUCT'
            ]),
            populateForEdit(id){
                this.POPULATE_FOR_EDIT(id);
            },
            populateForDelete(id){
                this.POPULATE_FOR_DELETE(id);
                $("#deleteModal").modal();
            },
            deleteProduct(id){
                this.DELETE_PRODUCT(id);
                $("#deleteModal").modal('hide');
            }
        },
        created(){
            if( localStorage.hasOwnProperty("workoutshop_token")){
                axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem("workoutshop_token");
            }
            this.GET_ALL_PRODUCTS();
        }
    }
</script>
