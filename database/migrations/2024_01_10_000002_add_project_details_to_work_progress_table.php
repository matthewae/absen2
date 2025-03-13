<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('work_progress', function (Blueprint $table) {
            $table->string('project_topic')->after('staff_id');
            $table->string('company_name')->after('project_topic');
            $table->text('work_description')->after('company_name');
        });
    }

    public function down(): void
    {
        Schema::table('work_progress', function (Blueprint $table) {
            $table->dropColumn(['project_topic', 'company_name', 'work_description']);
        });
    }
};