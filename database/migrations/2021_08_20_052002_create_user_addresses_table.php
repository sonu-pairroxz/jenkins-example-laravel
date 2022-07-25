<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('mobile_no',15);
            $table->string('email',50);
            $table->string('address',255);
            $table->string('city',20);
            $table->string('state',20);
            $table->string('country',20);
            $table->string('latitude',20)->nullable();
            $table->string('longitude',20)->nullable();
            $table->string('zipcode',10);
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
        Schema::dropIfExists('user_addresses');
    }
}
