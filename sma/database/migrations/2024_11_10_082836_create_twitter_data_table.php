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
        Schema::create('twitter_data', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->text('text');
            $table->timestamp('created_at');
            $table->integer('likes')->default(0);
            $table->integer('retweets')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twitter_data');
    }
};
