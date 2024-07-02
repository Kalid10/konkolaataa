<?php

use App\Models\CarBodyType;
use App\Models\CarBrand;
use App\Models\CarConditionType;
use App\Models\CarModel;
use App\Models\City;
use App\Models\EngineType;
use App\Models\FuelType;
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
            $table->integer('year');
            $table->unsignedBigInteger('exterior_color_id');
            $table->foreign('exterior_color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->unsignedBigInteger('interior_color_id');
            $table->foreign('interior_color_id')->references('id')->on('colors')->cascadeOnDelete();
            $table->boolean('is_original_paint')->default(true );
            $table->string('accident_severity')->default(0);
            $table->integer('plate_type');
            $table->string('transmission_type');
            $table->integer('mileage');
            $table->string('seller_type');
            $table->float('percentage')->default(0);
            $table->float('price');
            $table->string('price_type');
            $table->foreignIdFor( CarConditionType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FuelType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(EngineType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(CarBodyType::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->longText('description');
            $table->longText('google_map_location')->nullable();
            $table->string('location')->nullable();
            $table->string('status');
            $table->timestamp('posted_at');
            $table->timestamp('post_expires_at')->nullable();
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
