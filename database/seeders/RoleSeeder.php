<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createSuperAdministratorRole();
        $this->createDokterRole();
        $this->createPasienRole();
    }

    public function createSuperAdministratorRole(): void
    {
        $role = Role::findOrCreate('Kasir', 'cms');
        $role->givePermissionTo(Permission::where('guard_name','cms')->get());
    }
    public function createDokterRole(): void
    {
        $role = Role::findOrCreate('Dokter', 'dokter');
        $role->givePermissionTo(Permission::where('guard_name','dokter')->get());
    }
    public function createPasienRole(): void
    {
        $role = Role::findOrCreate('Pasien', 'pasien');
        $role->givePermissionTo(Permission::where('guard_name','pasien')->get());
    }
}
