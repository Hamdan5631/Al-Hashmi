<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('actual_price')->nullable();
            $table->double('sold_price')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->comment('ACTIVE,INACTIVE,SOLD');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
