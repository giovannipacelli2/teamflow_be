<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

use Ramsey\Uuid\Uuid;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('accounts')->insert([
            'id' => Uuid::uuid4()->toString(),
            'username' => 'admin',
            'email' => 'admin@dev.com',
            'name' => 'Giovanni',
            'surname' => 'Pacelli',
            'password' => Hash::make('abc1234'),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('accounts')->insert([
            'id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
            'username' => 'test',
            'email' => 'test@dev.com',
            'name' => 'Luca',
            'surname' => 'Neri',
            'password' => Hash::make('abc1234'),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('accounts')->insert([
            'id' => 'c0b52077-6404-427f-9766-d04b31ab4bd8',
            'username' => 'angeligu',
            'email' => 'ange@dev.com',
            'name' => 'Angelica',
            'surname' => 'Liguori',
            'password' => Hash::make('abc1234'),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);
    }
}