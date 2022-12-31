<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCategoriesTable extends Migration
{
    /**  
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_hin')->nullable();
            $table->string('name_frn')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_hin')->nullable();
            $table->string('slug_frn')->nullable();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->tinyInteger('status')->default()->nullable();
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
        Schema::dropIfExists('chield_categories');
    }
}
