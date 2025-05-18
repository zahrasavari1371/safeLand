<?php

use App\Models\Test;

function jdate_from_gregorian($input, $format = '%Y/%m/%d')
{
    return \Morilog\Jalali\Jalalian::fromDateTime($input)->format($format);
}

function rolesFaName($role)
{
    switch ($role) {
        case 'super admin':
            return 'سوپر ادمین';
            break;
        case 'admin':
            return 'ادمین';
            break;
        case 'inspector':
            return 'بازرس';
            break;
        case 'qc':
            return 'کنترل کیفی';
            break;
        case 'segment qc':
            return 'کنترل کیفی بخش';
            break;
        case 'supervisor':
            return 'مدیر عملیاتی';
            break;
    }
}

function statusColor($status){
    switch ($status) {
        case '1':
            return ['text-sky-600','جدید'];
        case '6':
            return ['text-orange-600','درحال بازرسی'];
        case '2':
            return ['text-gray-600','تایید QC'];
        case '4':
            return ['text-gray-600','تایید مدیر عملیاتی'];
        case '8':
            return ['text-emerald-600','بازرسی شده'];
        case '3':
        case '5':
        case '7':
            return ['text-rose-600','رد شده'];
    }
}

function convertPersianToEnglish($number): array|string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($persian, $english, $number);
}

function testName($id){
    $test=Test::query()->findOrFail($id);
    return $test->name;
}
