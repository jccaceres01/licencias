<?php

use Illuminate\Database\Seeder;
use App\Groups;
use App\Projects;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $projects = Projects::pluck('id');

      for($i=1; $i<=4; $i++) {
        Groups::create([
          'name' => 'Group '. $i,
          'project_id' => $projects[rand(1, sizeof($projects)-1)]
        ]);
      }
    }
}
