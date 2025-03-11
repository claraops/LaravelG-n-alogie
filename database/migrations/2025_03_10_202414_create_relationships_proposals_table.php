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
        Schema::create('relationships_proposals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/


    public function up()
{
    Schema::create('relationships_proposals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('parent_id');
        $table->unsignedBigInteger('child_id');
        $table->unsignedBigInteger('proposed_by');
        $table->string('status')->default('pending');
        $table->timestamps();

        $table->foreign('parent_id')->references('id')->on('people')->onDelete('cascade');
        $table->foreign('child_id')->references('id')->on('people')->onDelete('cascade');
        $table->foreign('proposed_by')->references('id')->on('users')->onDelete('cascade');
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationships_proposals');
    }
};
