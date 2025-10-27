<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jpo_id')->constrained('jpos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming you also have a users table
            $table->string('content');
            $table->enum('type', ['normal', 'offer'])->default('normal');
            $table->string('image')->nullable(); // Optional image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
