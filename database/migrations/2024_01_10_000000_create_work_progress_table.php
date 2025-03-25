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
            $table->foreignId('staff_id')->constrained()->onDelete('cascade');
            $table->foreignId('work_progress_id')->nullable()->constrained('work_progress')->onDelete('cascade');
            $table->string('company_name');
            $table->enum('project_topic', ['Perencanaan', 'Pengawasan', 'Kajian']);
            $table->text('work_description');
            $table->enum('status', ['Pending', 'In Progress', 'Revision', 'Completed']);
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