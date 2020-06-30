<template>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Product Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Example Name - With some details">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Product Category</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                    <option>Men</option>
                    <option>Women</option>
                    <option>Suplements</option>
                    <option>Gym Equipement</option>
                    <option>Accesories</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Quantity in stock</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="0">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Aditional Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Product image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedInputGroupCustomFile" required>
                            <label class="custom-file-label" for="validatedInputGroupCustomFile">Choose file...</label>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-lg btn-block">Confirm</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
