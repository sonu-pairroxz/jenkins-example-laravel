<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJitLearningNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jit_learning_notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('jit_learning_id')->nullable()->constrained('jit_learnings');
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('notification_text');
            $table->enum('read_status', ['Y','N'])->default('N');
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
        Schema::dropIfExists('jit_learning_notifications');
    }
}
