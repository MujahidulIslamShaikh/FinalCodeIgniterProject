<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('hello/(:any)', 'Home::greet/$1');


$routes->get('/', 'Form::index');

$routes->post('/submit-form', 'Form::submit');

$routes->get('/user_list', 'Form::list');   

$routes->get('delete-user/(:num)', 'Form::delete_user/$1');

$routes->get('/edit-user/(:num)','Form::edit_user/$1');

$routes->post('/update-user/(:num)','Form::update_user/$1');  

$routes->get('/signup-user','Auth::signup_user');
$routes->post('/signup-user','Auth::dosignup_user');

$routes->get('/login-user','Auth::login_user'); 

$routes->post('/login-user','Auth::dologin_user');
$routes->get('/logout-user','Auth::logout');

$routes->get('forgot', 'Auth::forgot');
$routes->post('forgot', 'Auth::handleForgot');
$routes->get('reset-password/(:segment)', 'Auth::resetForm/$1');
$routes->post('reset-password/(:segment)', 'Auth::resetPassword/$1');

$routes->get('send-email', 'Auth::testEmail');

$routes->get('/admin/upload-file','UploadController::uploadMethod');
$routes->post('/admin/upload-file','UploadController::saveFileMethod');
$routes->get('/display-file','UploadController::ShowFileDataMethod');

$routes->get('/admin/dashboard','Admin::dashboard');
$routes->get('/admin/login','Admin::login');
$routes->post('/admin/login','Admin::checkLogin');
$routes->get('/admin/logout','Admin::logout');

// $routes->get('/admin/ProductActions','UploadController::ProductActions');
$routes->get('/admin/prod-action','UploadController::ProductActions');

$routes->get('/admin/delete-product/(:num)','UploadController::DeleteProduct/$1');
$routes->get('/admin/edit-product/(:num)','UploadController::EditProduct/$1');

$routes->post('/admin/edit-product/(:num)','UploadController::UpdateProduct/$1');


// ========== Multiple Images Upload =====================

$routes->get('/admin/mult-image-upload', 'ImageController::upload');
$routes->post('/admin/mult-image-upload', 'ImageController::doupload');
// $routes->get('image/list', 'ImageController::list');

// $routes->resource('api/UserApiController');  // This maps to UserApi

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes){
    $routes->get('users', 'UserApiController::index');         // List
    $routes->get('users/(:num)', 'UserApiController::show/$1'); // Single
    $routes->post('users', 'UserApiController::create');        // Create
    $routes->put('users/(:num)', 'UserApiController::update/$1'); // Update
    $routes->delete('users/(:num)', 'UserApiController::delete/$1'); // Delete
});












