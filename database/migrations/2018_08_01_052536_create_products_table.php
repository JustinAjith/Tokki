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
            $table->string('category');
            $table->string('sub_category');
            $table->string('mini_category')->nullable();
            $table->string('heading');
            $table->string('key_word');
            $table->enum('discount_type', ['LKR', '%'])->default('LKR');
            $table->float('discount')->nullable()->default(0);
            $table->decimal('price', 10,2);
            $table->smallInteger('qty');
            $table->string('delivery_places');
            $table->string('image');
            $table->text('title');
            $table->text('description');
            $table->string('features')->nullable();
            $table->string('features_description')->nullable();
            $table->enum('status', ['Accept', 'Pending', 'Reject'])->default('Pending');
            $table->smallInteger('bid_value');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
