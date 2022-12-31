<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0)->nullable();
            $table->integer('subcategory_id')->default(0)->nullable();
            $table->integer('childcategory_id')->default(0)->nullable();
            $table->integer('tax_id')->nullable();
            $table->integer('brand_id')->default(0)->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_hin')->nullable();
            $table->string('name_frn')->nullable();
            $table->string('slug_en')->nullable();
            $table->string('slug_hin')->nullable();
            $table->string('slug_frn')->nullable();
            $table->string('sku')->nullable();
            $table->text('tags')->nullable();
            $table->text('video')->nullable();
            $table->text('sort_details')->nullable();
            $table->text('specification_name')->nullable();
            $table->text('specification_description')->nullable();
            $table->tinyInteger('is_specification')->default(0)->nullable();
            $table->text('details')->nullable();
            $table->string('photo')->nullable();
            $table->double('discount_price')->default(0)->nullable();
            $table->double('previous_price')->default(0)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->text('license_name')->nullable();
            $table->text('affiliate_link')->nullable();
            $table->text('license_key')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->tinyInteger('status')->default()->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('is_type')->nullable();
            $table->string('item_type')->nullable()->default('normal');
            $table->string('date')->nullable();
            $table->string('file')->nullable();
            $table->text('link')->nullable();
            $table->enum('file_type',['file', 'link'])->nullable();
            $table->integer('phot_deals')->nullable();
            $table->integer('pfeatured')->nullable();
            $table->integer('pspecial_offer')->nullable();
            $table->integer('pspecial_deals')->nullable();
            $table->string('fabric_id')->nullable();
            $table->string('pattern_id')->nullable();
            $table->string('sleeve_id')->nullable();
            $table->string('fit_id')->nullable();
            $table->string('occasion_id')->nullable();
            $table->string('neck_id')->nullable();  
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
        Schema::dropIfExists('items');
    }
}
