<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dokter::create([
            'nama'=>'Dr Jihan',
            'email'=>'drjihan@gmail.com',
            'umur'=>32,
            'spesialisasi'=>'Dokter Umum',
            'jam_kerja_start'=>'08:30',
            'jam_kerja_end'=>'17:30',
            'nominal'=>100000,
            'no_telepon'=>'214685425785',
            'password'=>Hash::make('1234asdf')

        ]);
        Pasien::create([
            'no_rm'=>'852145',
            'nama'=>'Hafiz',
            'nik'=>'123456',
            'jenis_kelamin'=>'L',
            'alamat'=>'xx',
            'email'=>'hafiz@gmail.com',
            'no_telepon'=>'214685425785',
            'login_status'=>0,
            'password'=>Hash::make('1234asdf')

        ]);
    }
}
