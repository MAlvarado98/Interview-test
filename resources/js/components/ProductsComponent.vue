<template>
    <div id="articles" class="container">
        <div class="row">
            <div class="col-md-12 mb-1">
                <div class="pricing-header">
                    <h1 class="display-4 mx-auto text-center"> Category Products</h1>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-primary">
                                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted"> <i class="fas fa-filter"></i> Filters</span>
                                    </h4>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label for="">Sorted</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                From Cheapiest to Most expensive
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                From Most expensive to Cheapiest
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label for="formControlRange">Maximum price <span>$0</span></label>
                                        <input type="range" class="form-control-range" id="formControlRange">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label for="">Brands</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Adidas</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Puma</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="form-group">
                                        <label for="">Sices</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">XS</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">S</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">M</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">L</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">XL</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">XXL</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-lg btn-block">Apply Filter</button>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="card-link" href="#">
                                        <div class="card">
                                            <img src="https://hips.hearstapps.com/vader-prod.s3.amazonaws.com/1585661930-41kfVzaBInL.jpg" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h4>0$</h4>
                                                <p class="card-text">Product name.</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
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
