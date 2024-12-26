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
        Schema::create('wallet', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 

            $table->integer('add_amount');
            $table->integer('lose_amount');
            $table->integer('win_amount');
            $table->integer('total_amount');

            $table->timestamps();
            
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('trash', ['Yes', 'No'])->default('No');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet');
    }
};
