<template>
    <div class="row" id="ProductCUComponent">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form @submit.prevent="">
                <div class="form-group">
                    <label for="productNameInput">Product Name</label>
                    <input v-model="product.name" type="text" class="form-control" id="productNameInput" placeholder="Example Name - With some details">
                </div>
                <div class="form-group">
                    <label for="productType">Product Category</label>
                    <select v-model="product.type" class="form-control" id="productType">
                        <option value="men" selected>Men</option>
                        <option value="women" >Women</option>
                        <option value="suplements" >Suplements</option>
                        <option value="gym-equipement" >Gym Equipement</option>
                        <option value="accesories" >Accesories</option>
                    </select>
                </div>
                <div v-if="operation == 'edit'" class="form-group">
                    <label for="productType">Product Status</label>
                    <select v-model="product.status" class="form-control" id="productType">
                        <option value="1" selected>Available</option>
                        <option value="0" >Not available</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantityStockInput">Quantity in stock</label>
                    <input v-model="product.stock" type="number" min="1" class="form-control" id="quantityStockInput" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="descriptionTextArea">Aditional Description</label>
                    <textarea v-model="product.description" class="form-control" id="descriptionTextArea" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="productPriceInput">Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input v-model="product.price" type="number" min="0" step="0.01" class="form-control" id="productPriceInput">
                    </div>
                </div>
                <div class="form-group">
                    <label for="imageInput">Product image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input v-if="operation=='create'" @change="imageChanged" type="file" class="custom-file-input" id="imageInput" required>
                            <input v-else @change="imageChanged" type="file" class="custom-file-input" id="imageInput">
                            <label class="custom-file-label" for="imageInput">Choose image...</label>
                        </div>
                    </div>
                </div>
                <button v-if="operation=='create'" @click="createProduct" type="submit" class="btn btn-success btn-lg btn-block">Confirm</button>
                <template v-else>
                    <button @click="updateProduct" type="submit" class="btn btn-success btn-lg btn-block">Update</button>
                </template>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default {
        beforeDestroy(){
            this.clearProduct();
        },
        computed:{
            ...mapState('product',[
                'product',
                'operation'
            ])
        },
        methods: {
            ...mapMutations('product',[
                'CREATE_PRODUCT',
                'UPDATE_PRODUCT',
                'CLEAR_PRODUCT'
            ]),
            imageChanged(e){
                var fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = (e) => {
                    this.product.image = e.target.result;
                }
            },
            createProduct(){
                this.CREATE_PRODUCT(this.product);
            },
            updateProduct(){
                this.UPDATE_PRODUCT(this.product);
            },
            clearProduct(){
                this.CLEAR_PRODUCT();
            }
        }
    }
</script>
