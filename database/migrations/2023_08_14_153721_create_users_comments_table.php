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
        Schema::create('user_comment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('comment_id');

            $table->timestamps();

            //IDX
            $table->index('user_id', 'user_comment_user_id_idx');
            $table->index('comment_id', 'user_comment_comment_id_idx');

            // FK
            $table->foreign('user_id', 'user_comment_user_id_fk')->on('users')->references('id');
            $table->foreign('comment_id', 'user_comment_comment_id_fk')->on('comments')->references('id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_comment');
    }
};
