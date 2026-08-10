<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('description')->nullable();

            $table->foreignUlid('created_by')->constrained('users')->nullOnDelete();
            $table->foreignUlid('department_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('assigned_department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignUlid('current_status_id')->nullable()->constrained('statuses')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('department_id');
            $table->index('assigned_department_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
