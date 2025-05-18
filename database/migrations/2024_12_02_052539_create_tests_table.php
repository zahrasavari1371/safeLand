<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام تست
            $table->string('short_name')->nullable(); // اضافه کردن ستون برای اسم مختصر
            $table->enum('type', ['technical', 'good']); // نوع تست
            $table->foreignId('parent_id')->nullable()->constrained('tests')->onDelete('cascade'); // رابطه والد
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
