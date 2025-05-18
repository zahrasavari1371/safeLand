<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin=User::query()->create([
            'name' => 'super',
            'surname' => 'admin',
            'email' => 'v.fadavi@safelandasia.com',
            'mobile' => '09121111111',
        ]);
        $superAdmin->assignRole('super admin');
        $superAdmin1=User::query()->create([
            'name' => 'super',
            'surname' => 'admin',
            'email' => 'z.savari2011@gmail.com',
            'mobile' => '09121111112',
        ]);
        $superAdmin1->assignRole('super admin');
    }
}
