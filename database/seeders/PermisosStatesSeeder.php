<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermisosStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'states-list',
            'states-create',
            'states-edit',
            'states-delete',

        ];

        foreach ($permissions as $permission) {

            Permissions::create(['name' => $permission]);
        }

        
       
    }
}
