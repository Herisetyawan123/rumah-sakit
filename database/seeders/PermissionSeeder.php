<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission untuk kasir
        $this->createResourcePermissionsFor('dashboard', 'cms');
        $this->createResourcePermissionsFor('kasir', 'cms');
        $this->createResourcePermissionsFor('roles', 'cms');
        $this->createResourcePermissionsFor('pasien', 'cms');
        $this->createResourcePermissionsFor("kategori_obat", "cms");
        $this->createResourcePermissionsFor("obat", "cms");
        $this->createResourcePermissionsFor('dokter', 'cms');
        $this->createResourcePermissionsFor('banks', 'cms');
        $this->createResourcePermissionsFor('resep_n_diagnosa', 'cms');
        $this->createResourcePermissionsFor('transaksi_obat', 'cms');
        $this->createResourcePermissionsFor('detail_transaksi_obat', 'cms');
        // $this->createResourcePermissionsFor('konsultasi', 'cms');
        Permission::findOrCreate('cms.konsultasi.viewAny');
        Permission::findOrCreate('cms.konsultasi.view');
        Permission::findOrCreate('cms.konsultasi.update');

        // Permission untuk dokter
        $this->createResourcePermissionsFor('dashboard', 'dokter');
        $this->createResourcePermissionsFor('resep_n_diagnosa', 'dokter');
        $this->createResourcePermissionsFor('konsultasi', 'dokter');
        $this->createResourcePermissionsFor('riwayat-konsultasi', 'dokter');
    }

    public function createResourcePermissionsFor(string $resource, string $cms): void
    {
        Permission::findOrCreate($cms . '.' . $resource . '.viewAny', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.view', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.create', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.update', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.delete', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.restore', $cms);
        Permission::findOrCreate($cms . '.' . $resource . '.forceDelete', $cms);
    }
}
