<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Schema::create('blogs', function (Blueprint $table) {
    //     $table->id();
    //     $table->string('title');
    //     $table->text('content');
    //     $table->string('thumbnail')->nullable();
    //     $table->boolean('is_active')->default(1);
    //     $table->unsignedBigInteger('category_id');
    //     $table->foreign('category_id')->references('id')->on('blog_catalogs')->onDelete('cascade');
    //     $table->timestamps();
    // });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
