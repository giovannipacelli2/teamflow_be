<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

use Ramsey\Uuid\Uuid;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // TODOS -> ACCOUNT: test

        DB::table('todos')->insert([
            'id' => 'f0e331d7-ccd7-4bea-91d7-51afee42c87b',
            'title' => 'Comprare il pane',
            'description' => '',
            'note' => 'Non l\'ho trovato',
            'category' => 'casa',
            'checked' => false,
            'account_id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('todos')->insert([
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Chiamare mamma',
            'description' => 'Chiedere a mamma se vuole venire a pranzo',
            'category' => 'famiglia',
            'checked' => false,
            'account_id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);

        DB::table('todos')->insert([
            'id' => Uuid::uuid4()->toString(),
            'title' => 'Andare in palestra',
            'description' => 'Ricorda la cintura',
            'category' => 'hobby',
            'checked' => false,
            'account_id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ]);
    }
}