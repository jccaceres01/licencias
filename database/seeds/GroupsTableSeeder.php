<?php

use Illuminate\Database\Seeder;
use App\Groups;
use App\Projects;
use App\Employees;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (Projects::all() as $project) {
        for ($i=0; $i<3; $i++) {
          Groups::create([
            'name' => $project->name.' grp: '.($i+1),
            'employee_id' => Employees::where('employee_type',
              'supervisor de grupo')->inRandomOrder()->take(1)->first()->id,
            'project_id' => $project->id
          ]);
        }
      }

      foreach(Employees::all() as $employee) {
        $employee->group_id = Groups::where('project_id', $employee->project_id)
        ->inRandomOrder()->first()->id;
        $employee->save();
      }
    }
}
