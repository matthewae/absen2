<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkProgressTable extends Migration
{
    public function up()
    {
        Schema::create('work_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'completed']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_progress');
    }
}
