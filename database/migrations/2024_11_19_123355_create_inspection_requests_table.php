<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inspection_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by'); //آیدی کسی که درخواست بازرسی رو ایجاد کرده
            $table->unsignedBigInteger('unit_id'); // آیدی بخشی که درخواست بازرسی براش ارسال شده
            $table->string('manufacturer')->nullable(); // تامین کننده یا سازنده
            $table->string('work_order')->nullable(); // شناسه ای مه توسط سیستم تولید میشه برای پیگیری های بعدی
            $table->json('tests'); // آیدی تست
            $table->text('size')->nullable(); // سایز آیتم
            $table->string('equipment_name')->nullable(); // نام تجهیز درخواست دهتده باید ثبت کند
            $table->string('serial_no')->nullable(); // شماره سریال که درخواست دهتده باید ثبت کند
            $table->string('location')->nullable(); // آدرس محل بازرسی
            $table->enum('inspection_type', ['technical', 'good'])->default('good'); // نوع بازرسی (محصول یا تکنیکال)
            $table->string('irn_no')->nullable();
            $table->enum('status', [1,2,3,4,5,6,7,8])->default(1); // وضعبت بازرسی
            // 1=> new , 2=> qc-confirmed , 3=> qc-rejected , 4=> supervisor-confirmed , 5=> supervisor-rejected ,
            // 6=> admin-confirmed , 7=> admin rejected , 8=> done
            $table->string('description')->nullable(); // توضیحات برای افزودن تست جدید
            $table->dateTime('start_date')->nullable(); // تاریخ درخواست بازرسی
            $table->dateTime('end_date')->nullable(); // تاریخ پابان بازرسی
            $table->dateTime('next_inspection_date')->nullable(); //
            $table->unsignedBigInteger('inspector')->nullable(); // آیدی بازرس
            $table->string('coordinator'); // نام و فامیل هماهنگ کننده در محل بازرسی
            $table->string('coordinator_mobile'); // شماره هماهنگ کننده در محل بازرسی

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('inspector')->references('id')->on('users');
            $table->foreign('unit_id')->references('id')->on('company_units');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_requests');
    }
};
