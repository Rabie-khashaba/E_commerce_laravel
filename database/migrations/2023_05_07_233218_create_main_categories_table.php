<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('main_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('translation_lang');
            $table ->Integer('translation_of');
            $table ->string('name');
            $table ->string('slug');
            $table ->string("photo");
            $table ->tinyInteger("active")->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_categories');
    }
};
