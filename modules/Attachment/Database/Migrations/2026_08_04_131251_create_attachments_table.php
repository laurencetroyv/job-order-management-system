<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->ulidMorphs('attachmentable');

            $table->string('original_name');
            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type');

            $table->unsignedInteger('file_size');

            $table->foreignUlid('uploaded_by')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('uploaded_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
