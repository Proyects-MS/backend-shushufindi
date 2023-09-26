<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermissionsAddSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Permissions::create([
            'name' => 'delete-file',
            'real_name' => 'Eliminar Archivo',                        
        ]);

        
        Permissions::create([
            'name' => 'replace-file',
            'real_name' => 'Reemplazar Archivo',                        
        ]);
    }
}
