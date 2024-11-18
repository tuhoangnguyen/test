<?php

namespace Database\Seeders;

use App\Models\Group;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Factory::create();
        // $group = new Group();
        // $group->name = $faker->name;
        // $group->save();

        Group::factory()->count(5)->sequence(
            ['name' => 'Administrator'],
            ['name' => 'Manager'],
            ['name' => 'Sales'],
            ['name' => 'Staff'],
            ['name' => 'Subscribers']
        )->hasUser(10)->create();

    }
}
