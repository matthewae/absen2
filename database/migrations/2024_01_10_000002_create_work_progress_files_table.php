<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkProgressFilesTable extends Migration
{
    public function up()
    {
        Schema::create('work_progress_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_progress_id')->constrained('work_progress')->onDelete('cascade');
            $table->string('filename');
            $table->string('file_path');
            $table->string('file_type');
            $table->integer('file_size');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_progress_files');
    }
}
