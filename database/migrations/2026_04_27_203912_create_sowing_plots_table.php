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
        Schema::create('sowing_plots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sowing_id');
            $table->foreign('sowing_id')->references('id')->on('sowings');
            $table->unsignedBigInteger('plot_id');              
            $table->foreign('plot_id')->references('id')->on('plots');
            $table->float('sown_quantity');
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sowing_plots');
    }
};
