<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Date;

use Ramsey\Uuid\Uuid;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $i = 0;
        $idIndex = 0;

        $ids = [
            '6ca498b0-3fb6-4094-ba16-42728383c587',
            '8cf7e740-05cf-4010-b230-47f587e41e7a'
        ];

        DB::table('comments')->whereIn('id', $ids)->delete();

        DB::table('comments')->insert([
            'id' => $ids[$idIndex++],
            'content' => 'Commento numero uno',
            'created_at' => Carbon::now()->addSecond($i++)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->addSecond($i++)->format('Y-m-d H:i:s'),
            'todo_id' => '1dcc7661-1251-456a-873c-2aa2028de9fd',
            'account_id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
        ]);
        DB::table('comments')->insert([
            'id' => $ids[$idIndex++],
            'content' => 'Commento numero due',
            'created_at' => Carbon::now()->addSecond($i++)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->addSecond($i++)->format('Y-m-d H:i:s'),
            'todo_id' => '1dcc7661-1251-456a-873c-2aa2028de9fd',
            'account_id' => '8a587029-80a2-4ae9-82e6-4f69f7383e63',
        ]);
    }
}
