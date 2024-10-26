<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

class AccountTodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('account_todo')->insert([
            'account_id' => 'c0b52077-6404-427f-9766-d04b31ab4bd8',
            'todo_id' => 'f0e331d7-ccd7-4bea-91d7-51afee42c87b',
        ]);
    }
}
