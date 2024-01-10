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
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->boolean('is_correct')->default(false);
            $table->integer('order')->default(0);
            $table->string('description')->nullable()->default(null);
            $table->string('explanation')->nullable()->default(null);
            $table->timestamps();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
