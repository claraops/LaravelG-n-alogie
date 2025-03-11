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
        Schema::create('modification_proposals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/


    public function up()
{
    Schema::create('modification_proposals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('person_id');
        $table->string('field');
        $table->text('new_value');
        $table->unsignedBigInteger('proposed_by');
        $table->string('status')->default('pending');
        $table->timestamps();

        $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
        $table->foreign('proposed_by')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_proposals');
    }
};
