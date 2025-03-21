<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkProgressFilesTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('work_progress_files')) {
            Schema::create('work_progress_files', function (Blueprint $table) {
                $table->id();
                $table->foreignId('work_progress_id')->constrained('work_progress')->onDelete('cascade');
                $table->string('original_name');
                $table->string('file_path');
                $table->string('mime_type');
                $table->integer('file_size');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('work_progress_files');
    }
};