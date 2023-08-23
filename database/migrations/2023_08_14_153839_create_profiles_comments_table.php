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
        Schema::create('profile_comment', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('comment_id');

            $table->timestamps();

            $table->index('profile_id', 'profile_comment_profile_id_idx');
            $table->index('comment_id', 'profile_comment_comment_id_idx');

            $table->foreign('profile_id', 'profile_comment_profile_id_fk')->on('profiles')->references('id');
            $table->foreign('comment_id', 'profile_comment_comment_id_fk')->on('comments')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_comment');
    }
};
