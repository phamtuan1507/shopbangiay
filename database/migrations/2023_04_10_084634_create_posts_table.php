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
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->index()->nullable();
            $table->string('path')->index()->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('type')->default('default');
            $table->integer('order')->default(0);
            $table->integer('author_id')->index()->nullable();
            $table->integer('status')->index()->default(0);
            $table->string('thumbnail')->nullable();
            $table->dateTime('published_date')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
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
