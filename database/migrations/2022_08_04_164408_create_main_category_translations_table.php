<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_category_id');
            $table->string('name');
            $table->string('locale');
            // $table->unique(['name', 'locale']);
            $table->foreign('main_category_id')->references('id')->on('main_categories')->onDelete('cascade');
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
        Schema::dropIfExists('main_category_translations');
    }
};