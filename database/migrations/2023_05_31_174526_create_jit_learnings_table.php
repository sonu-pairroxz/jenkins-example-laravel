<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJitLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jit_learnings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('ticket_id');
            $table->string('image')->nullable();
            $table->string('asin')->nullable();
            $table->string('product_name')->nullable();
            $table->text('keywords')->nullable();
            $table->string('error_type')->nullable();
            $table->string('sim')->nullable();
            $table->string('node')->nullable();
            $table->string('marketplace')->nullable();
            $table->string('correct_code')->nullable();
            $table->string('incorrect_code')->nullable();
            $table->text('learning')->nullable();
            $table->text('correct_methodology')->nullable();
            $table->text('reference')->nullable();
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
        Schema::dropIfExists('jit_learnings');
    }
}
