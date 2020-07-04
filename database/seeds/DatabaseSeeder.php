<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;
use App\Cart;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'role' => 2,
                'password' =>  Hash::make('password')
            ]
        ]);
        DB::table('users')->insert([
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'role' => 1,
                'password' =>  Hash::make('commonuser')
            ]
        ]); 
    }
}

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->insert(
            [
                'name' => 'White Adidas t-shirt',
                'id_image' => 'adidas-t-shirt.jpg',
                'description' => 'This is a great and expensive t-shirt',
                'price' =>  1199.99,
                'slug' => 'adidas-t-shirt',
                'status' => 1,
                'stock' => 50,
                'type' => 'men'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => '20 LB Hexagonal Dumbells',
                'id_image' => 'pair-hexagonal-dumbells.jpg',
                'description' => '20 LB Hexagonal Dumbells, excellent price.',
                'price' =>  1600.00,
                'slug' => 'pair-hexagonal-dumbells',
                'status' => 1,
                'stock' => 20,
                'type' => 'gym-equipement'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Dumbells set',
                'id_image' => 'dumbell-set.jpg',
                'description' => 'Set of dumbells with different weights.',
                'price' =>  11500.00,
                'slug' => 'dumbell-set',
                'status' => 1,
                'stock' => 5,
                'type' => 'gym-equipement'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'White Adidas t-shirt for woman',
                'id_image' => 'adidas-woma-t-shirt.jpg',
                'description' => 'Another great and expensive t-shirt.',
                'price' =>  900.00,
                'slug' => 'adidas-woma-t-shirt',
                'status' => 1,
                'stock' => 20,
                'type' => 'women'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Gold Whey Protein',
                'id_image' => 'gold-whey-protein.jpg',
                'description' => 'Protein to make you stronger.',
                'price' =>  899.99,
                'slug' => 'gold-whey-protein',
                'status' => 1,
                'stock' => 250,
                'type' => 'suplements'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Nitro Tech Protein',
                'id_image' => 'muscletech-nitro-tech-4lb_1.jpg',
                'description' => '4LB Protein.',
                'price' =>  949.99,
                'slug' => 'muscletech-nitro-tech-4lb_1',
                'status' => 1,
                'stock' => 110,
                'type' => 'suplements'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Nike Leggins',
                'id_image' => 'nike-leggins.jpg',
                'description' => 'Nice leggins to do exercise.',
                'price' =>  649.99,
                'slug' => 'nike-leggins',
                'status' => 1,
                'stock' => 335,
                'type' => 'women'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Gray Nike Belt',
                'id_image' => 'nike-belt.jpg',
                'description' => 'Belt to lift extreme weights.',
                'price' =>  1350.00,
                'slug' => 'nike-belt',
                'status' => 1,
                'stock' => 133,
                'type' => 'accesories'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Pair of Nike wistbands',
                'id_image' => 'pair-wristband-nike.jpg',
                'description' => 'Just to look cool.',
                'price' =>  330.00,
                'slug' => 'pair-wristband-nike',
                'status' => 1,
                'stock' => 46,
                'type' => 'accesories'
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Blue Nike pants',
                'id_image' => 'nike-blue-pants.jpg',
                'description' => '20 LB Hexagonal Dumbells, excellent price.',
                'price' =>  949.99,
                'slug' => 'nike-blue-pants',
                'status' => 1,
                'stock' => 548,
                'type' => 'men'
            ]
        );
    }
}
