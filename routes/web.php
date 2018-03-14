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
    return redirect()->route('home');
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

/**
 * Employees non resource routes
 */

Route::get('employees/{employee_id}/status/down', 'EmployeesController@down')
  ->name('employees.status.down'); // Change employee's status to down route
Route::get('employees/{employee_id}/status/up', 'EmployeesController@up')
  ->name('employees.status.up'); // Change employee's status to up route
Route::post('employees/equipmenst/add/{employee_id}',
'EmployeesController@addEquipment')->name('employees.equipments.add'); // Add equipment to employee
Route::get('employees/equipments/remove/{employee_id}/{equipment_type_id}',
'EmployeesController@removeEquipment')->name('employees.equipments.remove'); // Remove equipment from employee
Route::get('employees/equipments/{employee_id}/{equipment_type_id}/edit',
  'EmployeesController@editEmployeeEquipments')
  ->name('employees.equipments.edit'); // Show Edit form for employee's equipment type
Route::put('employees/equipments/{employee_id}/{equipment_id}',
  'EmployeesController@updateEmployeesEquipments')
  ->name('employees.equipments.update'); // Save edit form for employee's equipment type
Route::get('employees/licenses/expired', 'EmployeesController@expiredLicenses')
  ->name('employees.licenses.expired'); // Show employees with expired licenses
Route::get('employees/licenses/nextto/expire', 'EmployeesController@nextToExpire')
  ->name('employees.licenses.soon.expire'); // Show employees with licenses next to expire
Route::get('employees/down/view', 'EmployeesController@getDownEmployees')
  ->name('employees.down'); // Show down employees
Route::post('employees/courses/add/{employee_id}',
  'EmployeesController@addCourse')->name('employees.courses.add'); // Add course to employee
Route::get('employees/courses/remove/{employee_id}/{course_id}',
  'EmployeesController@removeCourse')->name('employees.courses.remove'); // Remove course from employee
  // Show Edit form for employee's courses
  Route::get('employees/courses/{employee_id}/{course_id}/edit',
    'EmployeesController@editEmployeeCourses')
    ->name('employees.courses.edit');
Route::put('employees/courses/{employee_id}/{course_id}',
  'EmployeesController@updateEmployeesCourses')
  ->name('employees.courses.update');  // Save edit form for employee's courses

/**
 * Reports Routes
 */

Route::get('reports/home', 'ReportsController@home')->name('reports.home'); // Home report route
Route::get('reports/employees/license/{employee_id}',
  'ReportsController@employeeLicence')->name('reports.employees.license'); // Carnets  routes
Route::get('reports/employees/equipments',
  'ReportsController@employeesEquipments')
  ->name('reports.employees.equipments'); // Employee's equipments report
Route::get('reports/employees/projects', 'ReportsController@employeesByProject')
  ->name('reports.employees.project'); // Employees by projects report route
Route::get('reports/employees/groups', 'ReportsController@employeesByGroup')
  ->name('reports.employees.group'); // Employees by groups report route
Route::get('report/employees/down', 'ReportsController@employeesDown')
  ->name('reports.employees.down'); // Get down employees report
Route::get('reports/employees/licenses/state',
  'ReportsController@licensesState')->name('employees.licenses.state'); // Return employees' license state
  
/**
 * User's routes
 */

Route::get('users/{id}/password/change/', 'UsersController@getChangePassword')
  ->name('users.password.change'); // return view for change password
Route::post('users/{id}/password/change/', 'UsersController@postChangePassword')
  ->name('users.password.change'); // update changes in password changes
Route::get('users/{id}/permissions', 'UsersController@getPermissions')
  ->name('users.permissions'); // return view to see permissions form
Route::post('users/{id}/permissions', 'UsersController@postPermissions')
  ->name('users.permissions'); // Save changes in the permissions form
