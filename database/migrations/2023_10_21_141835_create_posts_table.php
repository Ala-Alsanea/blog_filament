<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('title', 100);
            $table->string('image')->nullable();
            $table->timestamps();

            // $table->uuid('category_id')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();


            // if (Schema::hasTable('categories')) {
            // $table->uuid('category_id');

                // Artisan::call('db:wipe');
            // }





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
