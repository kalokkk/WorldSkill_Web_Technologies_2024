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
        Schema::create('campsites', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("location");
        });

        Schema::create('campsite_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->foreignId('campsite_id');
        });

        Schema::create('campsite_spots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('campsite_image_id');
            $table->foreignId('campsite_id');
        });

        Schema::create('campsite_spot_dates', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('campsite_spot_id');
        });

        Schema::create('campsite_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('remarks');
            $table->foreignId('campsite_spot_id');
            $table->foreignId('campsite_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campsites');
        Schema::dropIfExists('campsite_images');
        Schema::dropIfExists('campsite_spots');
        Schema::dropIfExists('campsite_spot_dates');
        Schema::dropIfExists('campsite_reservations');
    }
};
