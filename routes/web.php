<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Resource routes
 */

Route::resource('employees', 'EmployeesController');
Route::resource('equipmenttypes', 'EquipmentTypesController');
Route::resource('courses', 'CoursesController');
Route::resource('shifts', 'ShiftsController');
Route::resource('projects', 'ProjectsController');

/**
 * SPA Routes
 */
Route::get('shifts/index', 'HomeController@shifts')->name('shifts');

/**
 * Others
 */

 // Add equipment to employee
 Route::post('employees/equipmenst/add/{employee_id}',
  'EmployeesController@addEquipment')->name('employees.equipments.add');
 // Remove equipment from employee
 Route::get('employees/equipments/remvoe/{employee_id}/{equipment_type_id}',
  'EmployeesController@removeEquipment')->name('employee.equipments.remove');
