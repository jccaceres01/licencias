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
Route::resource('groups', 'GroupsController');
Route::resource('projects', 'ProjectsController');
Route::resource('contacts', 'ContactsController');
Route::resource('users', 'UsersController');

/**
 * SPA Routes
 */
Route::get('groups/index', 'HomeController@groups')->name('groups');

/**
 * Others
 */

// Add equipment to employee
Route::post('employees/equipmenst/add/{employee_id}',
'EmployeesController@addEquipment')->name('employees.equipments.add');
// Remove equipment from employee
Route::get('employees/equipments/remove/{employee_id}/{equipment_type_id}',
'EmployeesController@removeEquipment')->name('employees.equipments.remove');
// Show Edit form for employee's equipment type
Route::get('employees/equipments/{employee_id}/{equipment_type_id}/edit',
  'EmployeesController@editEmployeeEquipments')
  ->name('employees.equipments.edit');
// Save edit form for employee's equipment type
Route::put('employees/equipments/{employee_id}/{equipment_id}',
  'EmployeesController@updateEmployeesEquipments')
  ->name('employees.equipments.update');

// Add course to employee
Route::post('employees/courses/add/{employee_id}',
  'EmployeesController@addCourse')->name('employees.courses.add');
Route::get('employees/courses/remove/{employee_id}/{course_id}',
// Remove course from employee
  'EmployeesController@removeCourse')->name('employees.courses.remove');
  // Show Edit form for employee's courses
  Route::get('employees/courses/{employee_id}/{course_id}/edit',
    'EmployeesController@editEmployeeCourses')
    ->name('employees.courses.edit');
  // Save edit form for employee's courses
  Route::put('employees/courses/{employee_id}/{course_id}',
    'EmployeesController@updateEmployeesCourses')
    ->name('employees.courses.update');

/**
 * Reports Routes
 */
// Home report route
Route::get('reports/home', 'ReportsController@home')->name('reports.home');
// Carnets  routes
Route::get('reports/employees/license/{employee_id}',
  'ReportsController@employeeLicence')->name('reports.employees.license');
// Employee's equipments report
Route::get('reports/employees/equipments',
  'ReportsController@employeesEquipments')
  ->name('reports.employees.equipments');

// Users routes
Route::get('users/{id}/password/change/', 'UsersController@getChangePassword')
  ->name('users.password.change');
Route::post('users/{id}/password/change/', 'UsersController@postChangePassword')
  ->name('users.password.change');
Route::get('users/{id}/permissions', 'UsersController@getPermissions')
  ->name('users.permissions');
Route::post('users/{id}/permissions', 'UsersController@postPermissions')
  ->name('users.permissions');
