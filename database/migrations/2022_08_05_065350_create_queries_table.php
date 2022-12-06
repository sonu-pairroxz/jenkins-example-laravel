<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ticket_id')->unique();
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('asin');
            $table->string('work_stream');
            $table->string('marketplace');
            $table->string('tariff_node');
            $table->string('manager_id');
            $table->string('ruling_referred');
            $table->string('external_links');
            $table->string('document_referred');
            $table->integer('no_of_nfa_parked')->default(0);
            $table->string('itk');
            $table->text('requester_comment')->nullable();
            $table->text('resolver_comment')->nullable();
            $table->text('image_url')->nullable();
            $table->text('status')->nullable();
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
        Schema::dropIfExists('queries');
    }
}
