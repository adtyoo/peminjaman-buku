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
        Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title', 255);
        $table->string('author', 150);
        $table->string('publisher', 150);
        $table->year('year');
        $table->string('isbn', 50)->unique();

        $table->foreignId('category_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->integer('stock_total');
        $table->integer('stock_available');

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
