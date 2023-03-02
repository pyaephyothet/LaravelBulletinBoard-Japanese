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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->char('title', 255)->unique()->nullable(false);
            $table->char('description')->nullable(false);
            $table->unsignedTinyInteger('status')->default(1)->nullable(false);
            $table->unsignedBigInteger('create_user_id')->nullable(false);
            $table->foreign('create_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_user_id')->nullable(false);
            $table->foreign('updated_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('deleted_user_id')->nullable(true);
            $table->dateTime('created_at')->nullable(false);
            $table->dateTime('updated_at')->nullable(false);
            $table->dateTime('deleted_at')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};