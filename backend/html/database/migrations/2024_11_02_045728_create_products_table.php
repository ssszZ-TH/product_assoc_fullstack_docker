<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // สร้างคอลัมน์ id ที่เป็น primary key
            $table->string('code', 20)->unique(); // คอลัมน์ code (varchar 20) และ unique
            $table->string('name', 255)->unique(); // คอลัมน์ name (varchar 255) และ unique
            $table->date('introductiondate')->nullable(); // คอลัมน์ introductiondate (date) อาจจะเป็น null ได้
            $table->date('salesdiscontinuationdate')->nullable(); // คอลัมน์ salesdiscontinuationdate (date) อาจจะเป็น null ได้
            $table->string('comment', 255)->nullable(); // คอลัมน์ comment (varchar 255) อาจจะเป็น null ได้
            $table->string('producttype', 20)->nullable(); // คอลัมน์ producttype (varchar 20) อาจจะเป็น null ได้
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
