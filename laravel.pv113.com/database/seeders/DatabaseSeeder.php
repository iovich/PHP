<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        if(User::count()==0) {
//            User::factory(1)->create([
//                'name' => 'Марко Іван',
//                'email' => 'marko@gmail.com',
//                'password' => Hash::make('123456'),
//                'email_verified_at' => now(),
//            ]);
//        }
        if(Categories::count()==0) {
            Categories::factory(20)->create();
        }
        if(Product::count()==0) {
            Product::factory(20)->create();
        }
        if(ProductImage::count()==0) {
            ProductImage::factory(20)->create();
        }
//        Categories::factory()->create([
//
//        ]);

//        User::factory(1)->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//            'password' => Hash::make('123456'),
//        ]);
    }
}
