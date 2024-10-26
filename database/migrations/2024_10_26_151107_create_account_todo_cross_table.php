<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_todo', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignUuid('account_id')
                    ->references('id')->on('accounts')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();

            $table->foreignUuid('todo_id')
                    ->references('id')->on('todos')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_todo');
    }
};
