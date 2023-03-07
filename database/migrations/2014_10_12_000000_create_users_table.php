<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('image')->nullable();
            $table->string('mobile')->unique();
            $table->date('date');
            $table->enum('gender' , ['male' , 'female']);
            $table->enum('status' , ['active' , 'inactive'])->default('inactive');
            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id')->cascadeOnDelete();
            $table->morphs('actor');
            // $table->rememberToken();
            $table->timestamps();
            // $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
