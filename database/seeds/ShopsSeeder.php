<?php
 
use Illuminate\Database\Seeder;
 
class ShopsSeeder extends Seeder {
 
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('shops')->delete();
 
        $shops = array(
            ['id' => 1, 'name' => 'Fakta', 'slug' => 'fakta', 'latitude' => 57.040498, 'longitude' => 9.95115199999998, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'Lidl', 'slug' => 'lidl', 'latitude' => 57.063475, 'longitude' => 9.909117000000037, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Rema 1000', 'slug' => 'rema-1000', 'latitude' => 57.042103, 'longitude' => 9.94908799999996, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );
 
        // Uncomment the below to run the seeder
        DB::table('shops')->insert($shops);
    }
 
}