<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role as RoleModel;
use App\Models\Permissions;
use App\Models\RolePermission;


class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = RoleModel::create([
            'id' => 1,
            'name' => 'Administrador', 
            'supervisor' => 1                       
        ]);

        $permissions = Permissions::all();

        foreach ($permissions as $permission) {

            RolePermission::create(['role_id' => $role->id, 'permission_id' => $permission->id, 'is_allowed' => 1]);
        }

        $user = User::create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'identification_card' => 'admin',
            'password' => bcrypt('admin'),
            'role_id' => $role->id,
            'status' => 'A',
        ]);

    }
}
