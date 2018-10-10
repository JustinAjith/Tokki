<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('code', 30)->nullable();
            $table->unsignedInteger('category_id')->index();
            $table->unsignedInteger('sub_category_id')->index();
            $table->string('mini_category')->nullable();
            $table->string('heading');
            $table->string('key_word');
            $table->enum('discount_type', ['LKR', '%'])->default('LKR');
            $table->float('discount')->nullable()->default(0);
            $table->decimal('price', 10,2);
            $table->unsignedSmallInteger('qty');
            $table->string('delivery_places');
            $table->string('delivery_duration', 30);
            $table->string('image');
            $table->string('display_image', 30);
            $table->text('title');
            $table->text('description');
            $table->string('features')->nullable();
            $table->string('features_description')->nullable();
            $table->enum('status', ['Accept', 'Pending', 'Reject'])->default('Pending');
            $table->unsignedSmallInteger('bid_value');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
