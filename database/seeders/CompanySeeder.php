<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyAsset;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data1 = Company::create([
            'company_name' => 'PT Transisi Jakarta' ,
            'email' => 'PTTJ@gmail.com',
            'phone_number' => '085121431',
            'website' => 'pttj.com',
            'address' => 'Jakarta',
        ]);

       $data2 =  Company::create([
            'company_name' => 'PT Transisi Yogyakarta' ,
            'email' => 'PTTY@gmail.com',
            'phone_number' => '085121431',
            'website' => 'ptty.com',
            'address' => 'Yogyakarta',
        ]);

        CompanyAsset::create([
            'company_id' => $data1->id ,
            'file_name' => 'PTTJ@gmail.com',
            'url' => 'aaa',
        ]);

        CompanyAsset::create([
            'company_id' => $data2->id ,
            'file_name' => 'PTTY@gmail.com',
            'url' => 'bbb',
        ]);

        Division::create([
            'company_id' => $data1->id ,
            'division_name' => 'HRD Jakarta',
        ]);

        Division::create([
            'company_id' => $data1->id ,
            'division_name' => 'IT Jakarta',
        ]);

        Division::create([
            'company_id' => $data1->id ,
            'division_name' => 'Marketing Jakarta',
        ]);

        Division::create([
            'company_id' => $data2->id ,
            'division_name' => 'HRD Yogyakarta',
        ]);

        Division::create([
            'company_id' => $data2->id ,
            'division_name' => 'IT Yogyakarta',
        ]);

        Division::create([
            'company_id' => $data2->id ,
            'division_name' => 'Marketing Yogyakarta',
        ]);

        Position::create([
            'company_id' => $data1->id ,
            'position_name' => 'Backend Developer',
        ]);

        Position::create([
            'company_id' => $data1->id ,
            'position_name' => 'Accounting',
        ]);

        Position::create([
            'company_id' => $data1->id ,
            'position_name' => 'Talent Acquisition',
        ]);

        Position::create([
            'company_id' => $data2->id ,
            'position_name' => 'Backend Developer',
        ]);

        Position::create([
            'company_id' => $data2->id ,
            'position_name' => 'Accounting',
        ]);

        Position::create([
            'company_id' => $data2->id ,
            'position_name' => 'Talent Acquisition',
        ]);
    }
}
