<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 32)->unique();
            $table->string('interest', 32)->index();
            $table->string('name', 120);
            $table->string('organization', 160)->nullable();
            $table->string('email', 190);
            $table->string('phone', 40)->nullable();
            $table->string('subject', 160);
            $table->text('message');
            $table->json('details')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('mailed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
