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
        Schema::create('library_user_accesses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id_owner');
            $table->unsignedBigInteger('user_id_shared');

            $table->timestamps();

            $table->index('user_id_owner', 'library_user_accesses_user_id_owner_idx');
            $table->index('user_id_shared', 'library_user_accesses_user_id_shared_idx');

            $table->foreign('user_id_owner', 'library_user_accesses_user_id_owner_fk')->on('users')->references('id');
            $table->foreign('user_id_shared', 'library_user_accesses_user_id_shared_fk')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_user_accesses');
    }
};
