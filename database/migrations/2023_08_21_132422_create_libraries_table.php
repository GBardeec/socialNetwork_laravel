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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');

            $table->timestamps();

            $table->index('user_id', 'libraries_user_id_idx');
            $table->index('book_id', 'libraries_book_id_idx');

            $table->foreign('user_id', 'libraries_user_id_fk')->on('users')->references('id');
            $table->foreign('book_id', 'libraries_book_id_fk')->on('books')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
