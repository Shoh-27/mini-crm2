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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['To-Do', 'In Progress', 'Done'])->default('To-Do');
            $table->date('deadline')->nullable();
            $table->foreignId('assigned_to')->constrained('users')->onDelete('cascade');
            $table->nullableMorphs('taskable'); // lead yoki deal bilan bog‘lanish
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
