<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*public function up(): void
    {
        Schema::create('modification_votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/

    public function up()
{
    Schema::create('modification_votes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('proposal_id');
        $table->unsignedBigInteger('user_id');
        $table->string('vote'); // 'accept' ou 'reject'
        $table->timestamps();

        $table->foreign('proposal_id')->references('id')->on('modification_proposals')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_votes');
    }
};
