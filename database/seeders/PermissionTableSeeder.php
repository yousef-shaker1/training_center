<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Home',
            'section',
            'instructor',
            'course',
            'contact_us',
            'blog',
            'payment',
            'create_section',
            'edit_section',
            'delete_section',
            'create_instructor',
            'edit_instructor',
            'delete_instructor',
            'create_course',
            'edit_course',
            'delete_course',
            'delete_contact_us',
            'create_blog',
            'edit_blog',
            'delete_blog',
            'delete_payment', 
            
            'user',
            'create_user',
            'show_user',
            'edit_user',
            'delete_user',
            'role',
            'create_role',
            'show_role',
            'edit_role',
            'delete_role',
         ]; 
         
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
