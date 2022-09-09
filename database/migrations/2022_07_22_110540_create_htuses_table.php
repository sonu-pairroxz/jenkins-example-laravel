<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHtusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('htuses', function (Blueprint $table) {
            $table->id();
            $table->string('ruling_reference')->unique();
            $table->string('issuing_country')->nullable();
            $table->string('start_date_of_validity')->nullable();
            $table->string('end_date_of_validity')->nullable();
            $table->string('nomenclature_code')->nullable();
            $table->string('short_nomenclature_code')->nullable();
            $table->text('classification_justification')->nullable();
            $table->string('language')->nullable();
            $table->string('place_of_issue')->nullable();
            $table->string('date_of_issue')->nullable();
            $table->string('name_address')->nullable();
            $table->text('description_0f_goods')->nullable();
            $table->text('keywords')->nullable();
            $table->string('eccn')->nullable();
            $table->string('image_url')->nullable();
            $table->string('amazon_doc')->nullable();
            $table->string('chapter_note')->nullable();
            $table->text('comments')->nullable();
            $table->string('short_description')->nullable();
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
        Schema::dropIfExists('htuses');
    }
}
