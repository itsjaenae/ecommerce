<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_hin')->nullable();
            $table->string('name_frn')->nullable();
            $table->string('slug_en');
            $table->string('slug_hin')->nullable();
            $table->string('slug_frn')->nullable();
            $table->string('icon')->nullable(); 
            $table->string('photo')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_descriptions')->nullable();
            $table->tinyInteger('status')->default()->nullable();
            $table->tinyInteger('is_feature')->default()->nullable();
            $table->integer('serial')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
