<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permissions;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permissions::create([
            'name' => 'role-list',
            'real_name' => 'Lista de Roles',                        
        ]);

        Permissions::create([
            'name' => 'role-create',
            'real_name' => 'Crear Rol',                        
        ]);

        Permissions::create([
            'name' => 'role-edit',
            'real_name' => 'Editar Rol',                        
        ]);

        Permissions::create([
            'name' => 'role-delete',
            'real_name' => 'Eliminar Rol',                        
        ]);

        Permissions::create([
            'name' => 'user-list',
            'real_name' => 'Lista de Usuarios',                        
        ]);

        Permissions::create([
            'name' => 'user-create',
            'real_name' => 'Crear Usuario',                        
        ]);

        Permissions::create([
            'name' => 'user-edit',
            'real_name' => 'Editar Usuario',                        
        ]);

        Permissions::create([
            'name' => 'user-delete',
            'real_name' => 'Eliminar Usuario',                        
        ]);

        Permissions::create([
            'name' => 'process-assign',
            'real_name' => 'Asignar Proceso',                     
        ]);

        Permissions::create([
            'name' => 'process-list',
            'real_name' => 'Lista de Procesos',                   
        ]);

        Permissions::create([
            'name' => 'process-create',
            'real_name' => 'Crear Proceso',                       
        ]);

        Permissions::create([
            'name' => 'process-edit',
            'real_name' => 'Editar Proceso',                      
        ]);

        Permissions::create([
            'name' => 'process-delete',
            'real_name' => 'Eliminar Proceso',                    
        ]);

        Permissions::create([
            'name' => 'process-comment',
            'real_name' => 'Comentar Proceso',             
        ]);

        Permissions::create([
            'name' => 'file-upload',
            'real_name' => 'Subir Archivo',                      
        ]);

        Permissions::create([
            'name' => 'category-list',
            'real_name' => 'Lista de Categorias',                
        ]);

        Permissions::create([
            'name' => 'category-create',
            'real_name' => 'Crear Categoria',                    
        ]);

        Permissions::create([
            'name' => 'category-edit',
            'real_name' => 'Editar Categoria',                   
        ]);

        Permissions::create([
            'name' => 'category-delete',
            'real_name' => 'Eliminar Categoria',                 
        ]);

        Permissions::create([
            'name' => 'repository-list',
            'real_name' => 'Repositorio',               
        ]);

        Permissions::create([
            'name' => 'repository-create',
            'real_name' => 'Crear Repositorio',                   
        ]);

        Permissions::create([
            'name' => 'repository-edit',
            'real_name' => 'Editar Repositorio',                  
        ]);

        Permissions::create([
            'name' => 'repository-delete',
            'real_name' => 'Eliminar Repositorio',                
        ]);

        Permissions::create([
            'name' => 'states-list',
            'real_name' => 'Lista de Estados',               
        ]);

        Permissions::create([
            'name' => 'states-create',
            'real_name' => 'Crear Estado',                       
        ]);

        Permissions::create([
            'name' => 'states-edit',
            'real_name' => 'Editar Estado',                      
        ]);

        Permissions::create([
            'name' => 'states-delete',
            'real_name' => 'Eliminar Estado',                    
        ]);

        Permissions::create([
            'name' => 'settings',
            'real_name' => 'Configuraciones',              
        ]);
    }
}
