<template>
    <div class="mt-4">
        <table class="table">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Sold</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
                <tr>
                    <th scope="row">1</th>
                    <td>Mancuernas de 10 LB</td>
                    <td>GYM Equipement</td>
                    <td>Adidas</td>
                    <td>15</td>
                    <td>4</td>
                    <td><a class="btn btn-primary" href="#" role="button"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-secondary" href="#" role="button"><i class="fas fa-trash"></i></a></td>
                </tr>
            <tbody>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
