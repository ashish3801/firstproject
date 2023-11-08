<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Directory;
use Illuminate\Database\Seeder;
use App\Models\Detail;
use DB;
class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        
        for($i = 0; $i < 50; $i++) {
            // Detail::create([
            DB::table('details')->insert([
                'name' => $faker->name,
                'category' => $faker->word,
                'description' => $faker->sentence
            ]);
        }
    }
}
