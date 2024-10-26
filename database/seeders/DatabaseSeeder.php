<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $account = new AccountSeeder();
        $todo = new TodoSeeder();
        $account_todo = new AccountTodoSeeder();


        // RUN

        $account->run();
        $todo->run();
        $account_todo->run();
    }
}
