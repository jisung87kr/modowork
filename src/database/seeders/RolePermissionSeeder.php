<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Job Seeker permissions
            'view jobs',
            'apply for jobs',
            'view own applications',
            'update own profile',
            
            // Employer permissions  
            'create jobs',
            'update own jobs',
            'delete own jobs',
            'view job applications',
            'manage job applications',
            'view company profile',
            'update company profile',
            
            // Admin permissions
            'manage users',
            'manage companies',
            'manage all jobs',
            'view analytics',
            'manage categories',
            'manage locations',
            'manage permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $jobSeekerRole = Role::create(['name' => 'job_seeker']);
        $jobSeekerRole->givePermissionTo([
            'view jobs',
            'apply for jobs', 
            'view own applications',
            'update own profile',
        ]);

        $employerRole = Role::create(['name' => 'employer']);
        $employerRole->givePermissionTo([
            'view jobs',
            'create jobs',
            'update own jobs',
            'delete own jobs',
            'view job applications',
            'manage job applications',
            'view company profile',
            'update company profile',
            'update own profile',
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}