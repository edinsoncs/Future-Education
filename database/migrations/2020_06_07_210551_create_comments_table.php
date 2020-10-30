<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('message')->nullable();
            $table->integer('users')->unsigned()->nullable();
            $table->integer('courses')->unsigned()->nullable();
            $table->timestamps();
            
            /* Related database */
            $table->foreign('courses')
            ->references('id')
            ->on('courses')
            ->onDelete('cascade');
            
            /* Related database */
            $table->foreign('users')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
