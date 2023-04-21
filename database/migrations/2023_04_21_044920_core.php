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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
        });
        
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->integer('credit_balance')->default(0);
        });   
        
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('application_id')->nullable();   
            $table->unsignedBigInteger('employer_id')->nullable();   
            $table->unsignedBigInteger('intern_id')->nullable();   
        });          

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedBigInteger('employer_id')->nullable();   
        });   

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('type');
            $table->unsignedBigInteger('employer_id')->nullable();   
            $table->unsignedBigInteger('user_id');   
        });           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
