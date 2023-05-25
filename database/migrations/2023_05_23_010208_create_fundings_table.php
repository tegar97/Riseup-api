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
        Schema::create('fundings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('fund_raise_use');
            $table->unsignedBigInteger('ukm_id');
            $table->foreign('ukm_id')->references('id')->on('ukms');
            $table->string('image');
            $table->string('target_amount');
            $table->string('current_amount');
            $table->boolean('status')->default(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fundings');
    }
};
