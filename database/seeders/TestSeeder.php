<?php

namespace Database\Seeders;

use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تست اصلی
        $test1 = Test::query()->create([
            'name' => 'Raw Material Inspection',
            'short_name' => 'RMI',
            'type' => 'good',
        ]);
// زیرمجموعه‌ه
        $test1->children()->createMany([
            ['name' => 'Sampling','short_name'=>'sampling', 'type' => 'good'],
            ['name' => 'Laboratory Test Witness','short_name'=>'LTW', 'type' => 'good'],
        ]);

        // تست اصلی
        $test3 = Test::query()->create([
            'name' => 'Operational / Functional Test',
            'short_name' => 'OT',
            'type' => 'good',
        ]);
// زیرمجموعه‌ه
        $test3->children()->createMany([
            ['name' => 'Hydro-Static Test','short_name'=>'HST', 'type' => 'good'],
            ['name' => 'Leakage Test','short_name'=>'LT', 'type' => 'good'],
            ['name' => 'Performance Test','short_name'=>'PT', 'type' => 'good'],
            ['name' => 'In-Service Inspection','short_name'=>'ISI', 'type' => 'good'],
        ]);

        // تست اصلی
        $test4 = Test::query()->create([
            'name' => 'Destructive Test',
            'short_name' => 'DT',
            'type' => 'good',
        ]);
// زیرمجموعه‌ه
        $test4->children()->createMany([
            ['name' => 'Chemical Analyze','short_name'=>'CA', 'type' => 'good'],
            ['name' => 'Corrosion Resistance Analyze','short_name'=>'CRA', 'type' => 'good'],
            ['name' => 'Mechanical Analyze','short_name'=>'MA', 'type' => 'good'],
        ]);

        // تست اصلی
        $test5 = Test::query()->create([
            'name' => 'Non-Destructive Test',
            'short_name' => 'NDT',
            'type' => 'good',
        ]);
// زیرمجموعه‌ه
        $test5->children()->createMany([
            ['name' => 'Visual Test','short_name'=>'VT', 'type' => 'good'],
            ['name' => 'Magnetic Particle Test','short_name'=>'MPR', 'type' => 'good'],
            ['name' => 'Liquid Penetrant Test','short_name'=>'LPT', 'type' => 'good'],
            ['name' => 'Ultrasonic Test','short_name'=>'UT', 'type' => 'good'],
            ['name' => 'Radiographic Test','short_name'=>'RT', 'type' => 'good'],
            ['name' => 'Electromagnetic/Eddy Current Test','short_name'=>'EMT', 'type' => 'good'],
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Visual Inspection',
            'short_name' => 'VI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Quantity Check',
            'short_name' => 'QC',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Pre-Shipment Inspection',
            'short_name' => 'PSI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Re-Inspection',
            'short_name' => 'RI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Dimensional Check',
            'short_name' => 'DC',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Open Package Inspection',
            'short_name' => 'OPI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Inspection During Loading/Discharge',
            'short_name' => 'IDL',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Pre-Inspection Meeting',
            'short_name' => 'PIM',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Inspection During Construction & Commissioning',
            'short_name' => 'IDCC',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Document and Certificate Review',
            'short_name' => 'DCR',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Packing & Marking Inspection',
            'short_name' => 'PMI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Final Inspection',
            'short_name' => 'FI',
            'type' => 'good',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Visual Test',
            'short_name' => 'VT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Magnetic Particle Test',
            'short_name' => 'MPI',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Liquid Penetrant Test',
            'short_name' => 'LPT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Ultrasonic Test',
            'short_name' => 'UT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Radiographic Test',
            'short_name' => 'TR',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Electromagnetic/Eddy Current Test',
            'short_name' => 'EMI/ET',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Dimensional Test',
            'short_name' => 'DT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Hardness Test',
            'short_name' => 'HT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Thickness Measurement Test',
            'short_name' => 'TMT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Video Bore Scoping',
            'short_name' => 'VBS',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Load Test',
            'short_name' => 'LT',
            'type' => 'technical',
        ]);

        // تست اصلی
        Test::query()->create([
            'name' => 'Hydro Test',
            'short_name' => 'HT',
            'type' => 'technical',
        ]);
    }
}
