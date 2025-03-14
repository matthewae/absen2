<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('supervisor_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('department');
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('profile_picture_path')->nullable();
            $table->string('profile_picture_mime')->nullable();
            $table->integer('profile_picture_size')->nullable();
            $table->timestamp('profile_picture_updated_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};