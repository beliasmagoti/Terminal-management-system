<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage_tanks',
            'manage_users',
            'manage_sensors',
            'manage_deliveries',
            'manage_transfers',
            'manage_alerts',
            'view_dashboard',
            'view_auditlogs'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name'=> 'Super Admin'

       ] );
            $manager = Role::firstOrCreate([
            'name'=> 'Terminal Manager'

       ] );
            $Supervisor = Role::firstOrCreate([
            'name'=> 'Terminal Supervisor'

       ] );
            $operator = Role::firstOrCreate([
            'name'=> 'Terminal Operator'

       ] );
            $technician = Role::firstOrCreate([
            'name'=> 'Terminal Technician'

       ] );
            $auditor = Role::firstOrCreate([
            'name'=> 'Auditor'

       ] );



       $superAdmin -> givePermissionTo(
        Permission::all()
       );

       $manager -> givePermissionTo([
          'manage_tanks',
           'manage_users',
            'manage_deliveries',
            'manage_transfers',
            'manage_alerts',
            'view_dashboard',
       ]
       
       );

        $operator -> givePermissionTo([
        
            'view_dashboard',
       ]
       
       );
        $technician -> givePermissionTo([
        
        
            'manage_sensors',
            'manage_alerts',
            'view_dashboard',
       ]
       
       );
        $Supervisor -> givePermissionTo([
            'manage_deliveries',
            'manage_transfers',
            'view_dashboard',
       ]
       
       );

        $auditor -> givePermissionTo([
          
            'view_auditlogs'
       ]
       
       );








    }
}
