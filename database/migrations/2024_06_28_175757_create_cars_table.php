<?php

use App\Models\CarModel;
use App\Models\Color;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CarModel::class)->constrained()->cascadeOnDelete();
            $table->timestamp('year');
            $table->unsignedBigInteger('exterior_color_id');
            $table->foreign('exterior_color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->unsignedBigInteger('interior_color_id');
            $table->foreign('interior_color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->boolean('is_painted_again')->default(false);
            $table->unsignedBigInteger('previous_paint_color_id')->nullable();
            $table->foreign('previous_paint_color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->integer('number_of_accidents')->default(0);
            $table->integer('license_plate_type');
            $table->enum('transmission', ['manual', 'automatic', 'semi-automatic']);
            $table->integer('mileage');
            $table->integer('price');
            $table->enum('status', ['new', 'used']);
            $table->enum('fuel', ['diesel', 'petrol', 'electric', 'hybrid']);
            $table->float('engine_size');
            $table->longText('description');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
