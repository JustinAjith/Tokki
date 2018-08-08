<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->unique();
            $table->string('name', 80);
            $table->string('email', 80)->unique();
            $table->string('password');
            $table->string('profile')->default('default-profile.png');
            $table->string('address', 100)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('land_line', 20)->nullable();
            $table->text('about_us')->nullable();
            $table->smallInteger('bid');
            $table->smallInteger('total_bid');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
