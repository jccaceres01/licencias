<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Resource api controllers
 */
Route::resource('equipmenttypes', 'Api\EquipmentTypesController');
Route::resource('courses', 'Api\CoursesController');


/**
 * Functional Api data
 */
Route::get('projects/{project_id}/groups',
  'Api\GroupsController@groupsByProjects');
/**
 * Charts api routes
 */
