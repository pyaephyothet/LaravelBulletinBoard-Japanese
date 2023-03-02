<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->char('name')->unique()->nullable(false);
            $table->char('email', 255)->unique()->nullable(false);
            $table->text('password')->nullable(false);
            $table->text('profile', 255)->nullable(false);
            $table->unsignedTinyInteger('role')->default(1)->nullable(false);
            $table->char('phone', 255);
            $table->char('address', 255);
            $table->date('dob');
            $table->unsignedBigInteger('create_user_id')->nullable(false);
            $table->foreign('create_user_id')->references('id')->on('users');
            $table->unsignedBigInteger('updated_user_id')->nullable(false);
            $table->foreign('updated_user_id')->references('id')->on('users');
            $table->integer('deleted_user_id')->nullable(true);
            $table->date('created_at')->nullable(false);
            $table->date('updated_at')->nullable(false);
            $table->date('deleted_at')->nullable(true);
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
};
