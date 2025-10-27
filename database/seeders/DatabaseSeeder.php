<?php

namespace Database\Seeders;

use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role'=> 'admin',
        ]);
        User::factory()->create([
            'name' => 'company1',
            'email' => 'company@example.com',
            'role'=> 'company',
        ]);
        User::factory()->create([
            'name' => 'Resp1',
            'email' => 'resp@example.com',
            'role'=> 'resp',
        ]);

           Tag::create(['name'=>'IT','slug'=>'it']);
           Tag::create(['name'=>'Civil','slug'=>'civil']);
           Tag::create(['name'=>'Bio','slug'=>'bio']);
           Tag::create(['name'=>'EA','slug'=>'ea']);
           Tag::create(['name'=>'EM','slug'=>'em']);
           Tag::create(['name'=>'Architecture','slug'=>'architecture']);


    }
}
