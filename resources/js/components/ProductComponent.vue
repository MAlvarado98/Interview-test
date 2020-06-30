<template>
    <div class="container" id="ProductComponent">
        <h1 class="text-center">Product name - with some details</h1>
        <div class="row">
            <div class="col-md-8">
                <img class="product-image" src="https://images-na.ssl-images-amazon.com/images/I/816lKIQ3C8L._AC_SX425_.jpg" alt="">
            </div>
            <div class="col-md-4">
                <form action="">
                    <h3 class="product-price">Price: $100.00</h3>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quantity</label>
                        <input type="number" value="1" min="1" max="10" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Color</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                        <option>red</option>
                        <option>blue</option>
                        <option>yellow</option>
                        <option>green</option>
                        <option>white</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Size</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                        <option>XS</option>
                        <option>S</option>
                        <option>M</option>
                        <option>L</option>
                        <option>XL</option>
                        <option>XXL</option>
                        </select>
                    </div>
                    <h3 class="product-price mt-5">Total: $100.00</h3>
                    <button type="button" class="btn btn-success btn-lg btn-block"> <i class="fas fa-cart-plus"></i> Add to Cart</button>
                </form>
            </div>
        </div>
        <div class="row">
            <h3>Product description</h3>
            <p> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fringilla urna et arcu viverra pellentesque in non justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur egestas velit ac nisi blandit, non gravida augue porta. Nunc vitae ornare diam. Mauris commodo magna in vehicula lobortis. Sed accumsan ullamcorper ipsum, sit amet accumsan ex ornare sit amet. Nunc mi sem, lacinia ac massa ac, posuere laoreet augue. Curabitur in sem quam.

                Vivamus ultricies volutpat luctus. Aenean mattis neque ut justo sollicitudin, eu tincidunt ligula consequat. Sed vel quam tellus. Integer lobortis bibendum augue, sed pretium erat luctus non. Vivamus euismod elit nibh, in sodales lectus luctus non. Nulla vehicula non lectus sit amet sagittis. Phasellus vulputate mi mi, non pharetra massa vestibulum sit amet. Mauris porta luctus augue, quis lobortis dolor pulvinar id. In dapibus imperdiet lectus vitae ultrices. Nullam scelerisque mollis felis congue convallis. Maecenas volutpat, nisi quis viverra pulvinar, ligula quam consectetur erat, id condimentum ante odio egestas turpis. Ut id posuere dui. Suspendisse bibendum purus lorem, sed lobortis sem sagittis molestie.

                Nunc egestas ultricies turpis, ac euismod sapien rutrum eget. Sed tristique posuere purus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean ut erat pulvinar felis facilisis lacinia. Duis posuere purus in tellus tincidunt, ut dapibus justo bibendum. Sed cursus ligula ac convallis ullamcorper. Mauris diam dui, lobortis sed leo eu, varius imperdiet nisi. Phasellus convallis, enim eget lobortis semper, neque mauris sagittis odio, id auctor risus lacus sed justo. Vivamus eget erat iaculis, suscipit ipsum ut, tincidunt ante. Praesent nisl arcu, consequat a accumsan eu, pharetra non dui. Praesent sagittis ex purus, vel rutrum dolor mattis nec. Vestibulum et dolor facilisis, scelerisque elit faucibus, semper lectus. In vel ligula non arcu sodales accumsan ut non nisi. In nec vulputate orci. Vestibulum vitae dolor in diam ornare scelerisque eu id enim. Praesent porttitor scelerisque felis nec tristique.

                Aenean erat massa, accumsan sit amet risus non, maximus suscipit nunc. In eu euismod nibh. Proin mollis nibh quis porttitor tincidunt. Integer felis sapien, interdum sed tellus sit amet, congue luctus enim. Maecenas lobortis rhoncus ullamcorper. Vestibulum non mollis justo. Quisque vitae urna vel nulla varius suscipit. Integer ante mi, efficitur in massa id, maximus mollis odio. Curabitur vel laoreet risus, in semper enim. Praesent interdum, augue at condimentum aliquet, nisi turpis imperdiet ipsum, a congue nulla lectus sit amet arcu. Etiam accumsan ut arcu eget faucibus. Nam posuere nulla nec lorem congue lobortis. Suspendisse vitae ante tortor. Maecenas ut ex ex. Nullam quis tortor metus. Nulla id mi felis.
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
