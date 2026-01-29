<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropForeign(['artist_id']);
            $table->foreign('artist_id')
                ->references('id')->on('artists')
                ->onDelete('cascade');

            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropForeign(['artist_id']);
            $table->foreign('artist_id')->references('id')->on('artists');

            $table->dropForeign(['category_id']);
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

};
