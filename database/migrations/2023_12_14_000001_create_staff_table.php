<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('position');
            $table->string('department');
            $table->string('phone_number')->nullable();
            $table->date('birth_date')->nullable();
            $table->longblob('profile_picture')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('set null');
            $table->rememberToken();
            $table->timestamps();
            $table->string('address')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};