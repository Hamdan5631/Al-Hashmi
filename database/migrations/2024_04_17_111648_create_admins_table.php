<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile_country_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('password');
            $table->string('role')->comment('SUPER ADMIN , EMPLOYEE');
            $table->string('status')->comment('ACTIVE, BLOCKED')->default('ACTIVE');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
