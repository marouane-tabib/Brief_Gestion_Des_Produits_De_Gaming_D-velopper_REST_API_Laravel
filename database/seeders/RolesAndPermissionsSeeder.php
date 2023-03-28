<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'edit my profil']);
        Permission::create(['name' => 'edit all profil']);
        Permission::create(['name' => 'delete my profil']);
        Permission::create(['name' => 'delete all profil']);
        Permission::create(['name' => 'view my profil']);
        Permission::create(['name' => 'view all profil']);

        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit All product']);
        Permission::create(['name' => 'edit My product']);
        Permission::create(['name' => 'delete All product']);
        Permission::create(['name' => 'delete My product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'view my product']);

        Permission::create(['name' => 'add category']);
        Permission::create(['name' => 'edit category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'view category']);

        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'change role user']);

        // Define roles available
        $admin = 'admin';
        $seller = 'seller';
        $user = 'user';

        Role::create(['name' => $admin])->givePermissionTo(Permission::all());

        Role::create(['name' => $seller])->givePermissionTo([
            'add product',
            'edit My product',
            'delete My product',
            'view my product',
            'edit my profil',
            'delete my profil',
            'view my profil',
        ]);

        Role::create(['name' => $user])->givePermissionTo([
            'edit my profil',
            'delete my profil',
            'view my profil',
        ]);
    }
}
