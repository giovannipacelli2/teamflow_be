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
    }
}