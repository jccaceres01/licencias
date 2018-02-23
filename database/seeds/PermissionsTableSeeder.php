<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');

      /**
       * Create Permissions
       */

      // Admin permission
      Permission::create(['name' => 'administrator']);

      // Proyects permissions
      Permission::create(['name' => 'view projects']);
      Permission::create(['name' => 'create projects']);
      Permission::create(['name' => 'edit projects']);
      Permission::create(['name' => 'delete projects']);
      Permission::create(['name' => 'list projects']);

      // Employees permissions
      Permission::create(['name' => 'view employees']);
      Permission::create(['name' => 'create employees']);
      Permission::create(['name' => 'edit employees']);
      Permission::create(['name' => 'delete employees']);
      Permission::create(['name' => 'list employees']);

      // Equipment Types permissions
      Permission::create(['name' => 'view equipment_types']);
      Permission::create(['name' => 'create equipment_types']);
      Permission::create(['name' => 'edit equipment_types']);
      Permission::create(['name' => 'delete equipment_types']);
      Permission::create(['name' => 'list equipment_types']);

      // Courses permissions
      Permission::create(['name' => 'view courses']);
      Permission::create(['name' => 'create courses']);
      Permission::create(['name' => 'edit courses']);
      Permission::create(['name' => 'delete courses']);
      Permission::create(['name' => 'list courses']);

      // Shifts permissions
      Permission::create(['name' => 'view groups']);
      Permission::create(['name' => 'create groups']);
      Permission::create(['name' => 'edit groups']);
      Permission::create(['name' => 'delete groups']);
      Permission::create(['name' => 'list groups']);

      // Reports permissions
      Permission::create(['name' => 'view reports']);

      // Operations permissions
      Permission::create(['name' => 'attach equipment_types']);
      Permission::create(['name' => 'detach equipment_types']);
      Permission::create(['name' => 'edit asigned equipment_types']);
      Permission::create(['name' => 'attach courses']);
      Permission::create(['name' => 'detach courses']);
      Permission::create(['name' => 'edit asigned courses']);

      /**
       * Asign permissions
       */

      $user = User::find(1); // Find user with id 1

      // Employees asign permissions
      $user->givePermissionTo('view employees');
      $user->givePermissionTo('edit employees');
      $user->givePermissionTo('create employees');
      $user->givePermissionTo('delete employees');
      $user->givePermissionTo('list employees');

      // Equipment_types asign permissions
      $user->givePermissionTo('view equipment_types');
      $user->givePermissionTo('edit equipment_types');
      $user->givePermissionTo('create equipment_types');
      $user->givePermissionTo('delete equipment_types');
      $user->givePermissionTo('list equipment_types');

      // Courses asign permissions
      $user->givePermissionTo('view courses');
      $user->givePermissionTo('edit courses');
      $user->givePermissionTo('create courses');
      $user->givePermissionTo('delete courses');
      $user->givePermissionTo('list courses');

      // Projects asign permissions
      $user->givePermissionTo('view projects');
      $user->givePermissionTo('edit projects');
      $user->givePermissionTo('create projects');
      $user->givePermissionTo('delete projects');
      $user->givePermissionTo('list projects');

      // Shifts asign permissions
      $user->givePermissionTo('view groups');
      $user->givePermissionTo('edit groups');
      $user->givePermissionTo('create groups');
      $user->givePermissionTo('delete groups');
      $user->givePermissionTo('list groups');

      // Reports
      $user->givePermissionTo('view reports');

      // Administrator permission
      $user->givePermissionTo('administrator');

      // Operations asign permissions
      $user->givePermissionTo('attach equipment_types');
      $user->givePermissionTo('detach equipment_types');
      $user->givePermissionTo('edit asigned equipment_types');
      $user->givePermissionTo('attach courses');
      $user->givePermissionTo('detach courses');
      $user->givePermissionTo('edit asigned courses');
    }
}
