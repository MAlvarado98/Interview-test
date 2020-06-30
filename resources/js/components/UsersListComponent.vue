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
                <tr>
                    <th scope="row">1</th>
                    <td>Mario Alvarado</td>
                    <td>tec.marioalvarado@gmail.com</td>
                    <td>Common user</td>
                    <td><a class="btn btn-primary" href="#" role="button"><i class="fas fa-edit"></i></a></td>
                    <td><a class="btn btn-secondary" href="#" role="button"><i class="fas fa-trash"></i></a></td>
                </tr>
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
