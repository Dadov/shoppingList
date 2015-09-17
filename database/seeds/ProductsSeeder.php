<?php
 
use Illuminate\Database\Seeder;
 
class ProductsSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('products')->delete();
 
        $products = array(
            ['id' => 1, 'name' => 'Bread', 'slug' => 'bread', 'price' => '20', 'shop_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'Beer', 'slug' => 'beer', 'price' => '10', 'shop_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Wine','slug' => 'wine', 'price' => '30', 'shop_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'name' => 'Sausages', 'slug' => 'sausages', 'price' => '15', 'shop_id' => 1, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'name' => 'Bacon', 'slug' => 'bacon', 'price' => '8', 'shop_id' => 3, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 6, 'name' => 'Tomatoes', 'slug' => 'tomatoes', 'price' => '2', 'shop_id' => 2, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 7, 'name' => 'Lollipop', 'slug' => 'lollipop', 'price' => '3', 'shop_id' => 2, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
 
        //// Uncomment the below to run the seeder
        DB::table('products')->insert($products);
    }
 
}