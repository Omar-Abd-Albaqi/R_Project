<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserWithPermissions extends Seeder
{
  
    public function run(): void
    {
    
        $manageProducts = Permission::firstOrCreate(['name' => 'manage products']);

       
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $adminRole->givePermissionTo([$manageProducts]);

      

        $admin = User::firstOrCreate(
            ['email' => 'admin@product.com'],
            [
                'name' => 'Admin product',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        

      
    }
}
