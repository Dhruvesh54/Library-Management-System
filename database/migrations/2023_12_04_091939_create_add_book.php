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
        Schema::create('add_book', function (Blueprint $table) {
            $table->id();
            $table->string('book_code');
            $table->string('book_barcode');
            $table->string('name');
            $table->string('topic');
            $table->string('author');
            $table->string('edition');
            $table->string('quantity');
            $table->string('language');
            $table->string('ststus')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_book');
    }
};
