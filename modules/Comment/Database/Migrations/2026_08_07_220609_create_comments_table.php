<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('body');
            $table->foreignUlid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('ticket_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'ticket_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
