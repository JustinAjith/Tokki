<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->string('name');
            $table->string('street');
            $table->string('city');
            $table->string('mobile', 15);
            $table->string('telephone', 15);
            $table->enum('discount_type', ['LKR', '%']);
            $table->float('discount')->nullable()->default(0);
            $table->decimal('price', 10,2);
            $table->smallInteger('qty');
            $table->string('delivery_places');
            $table->string('features')->nullable();
            $table->string('features_description')->nullable();
            $table->smallInteger('bid_value');
            $table->enum('status', ['Complete', 'Accept', 'Pending', 'Reject'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
