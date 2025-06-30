<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('hello/(:any)', 'Home::greet/$1');


$routes->get('/', 'Form::index');
$routes->get('/form', 'Form::formreturn');

$routes->post('/submit-form', 'Form::submit');

$routes->get('/user_list', 'Form::list');
$routes->get('/user_list_api', 'Form::listApi');

$routes->get('delete-user/(:num)', 'Form::delete_user/$1');

$routes->get('/edit-user/(:num)', 'Form::edit_user/$1');

$routes->post('/update-user/(:num)', 'Form::update_user/$1');

$routes->get('/signup-user', 'Auth::signup_user');
$routes->post('/signup-user', 'Auth::dosignup_user');

$routes->get('/login-user', 'Auth::login_user');
$routes->get('/Noor', 'Auth::loginuserlist');



$routes->post('/login-user', 'Auth::dologin_user');
$routes->get('/logout-user', 'Auth::logout');

$routes->get('forgot', 'Auth::forgot');
$routes->post('forgot', 'Auth::handleForgot');
$routes->get('reset-password/(:segment)', 'Auth::resetForm/$1');
$routes->post('reset-password/(:segment)', 'Auth::resetPassword/$1');

$routes->get('send-email', 'Auth::testEmail');

$routes->get('/admin/upload-file', 'UploadController::uploadMethod');
$routes->post('/admin/upload-file', 'UploadController::saveFileMethod');
$routes->get('/display-file', 'UploadController::ShowFileDataMethod');
//==========================================
$routes->get('/admin/dashboard', 'Admin::dashboard');
$routes->get('/admin/login', 'Admin::login');
$routes->post('/admin/login', 'Admin::checkLogin');
$routes->get('/admin/logout', 'Admin::logout');

// $routes->get('/admin/ProductActions','UploadController::ProductActions');
$routes->get('/admin/prod-action', 'UploadController::ProductActions');

$routes->get('/admin/delete-product/(:num)', 'UploadController::DeleteProduct/$1');
$routes->get('/admin/edit-product/(:num)', 'UploadController::EditProduct/$1');

$routes->post('/admin/edit-product/(:num)', 'UploadController::UpdateProduct/$1');


// ========== Multiple Images Upload =====================

$routes->get('/admin/mult-image-upload', 'ImageController::upload');
$routes->post('/admin/mult-image-upload', 'ImageController::doupload');
// $routes->get('image/list', 'ImageController::list');

// $routes->resource('api/UserApiController');  // This maps to UserApi

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('users', 'UserApiController::index');         // List
    $routes->get('users/(:num)', 'UserApiController::show/$1'); // Single
    $routes->post('users', 'UserApiController::create');        // Create
    $routes->put('users/(:num)', 'UserApiController::update/$1'); // Update
    $routes->delete('users/(:num)', 'UserApiController::delete/$1'); // Delete
});


$routes->group('/', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('ProductListApiView', 'ProductApiController::productView');
    $routes->get('FilterProductListApiView', 'ProductApiController::FilterProductView'); //
});


// $routes->get('/admin/product', 'ProductApiController::productView', ['namespace' => 'App\Controllers\Api']);
// ===================== OR ===============
// $routes->group('admin', ['namespace' => 'App\Controllers\Api'], function($routes) {
//     $routes->get('product_list', 'ProductApiController::productView');
// });


// ========================================= General And PDF Controller  =======================================================================================================
$routes->get('pdf_template', 'GeneralController::pdf_template');
$routes->get('pdf/product_list_pdf', 'GeneralController::product_list_pdf');
$routes->get('pdf/cateListpdf', 'GeneralController::CategoryListPdf');
$routes->get('pdf/Brand_list_pdf', 'GeneralController::Brand_list_pdf');

// ========================================= signupView =======================================================================================================

$routes->get('signupView', 'AuthController::signupView', ['namespace' => 'App\Controllers\Api']);
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('signupcreate', 'AuthController::create'); // create
});
/////////// OR \\\\\\\\\\\\\\\\\\\
// $routes->group('api', function($routes) {  
//     $routes->post('users', 'Api\UserApi::create');
// });

// =============== IMAGE FILE UPLOAD API HERE ============================
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('imageupload/upload', 'ImageUploadController::upload');
});


$routes->get('/CreateProductView', 'GeneralController::CreateProductView');
$routes->get('/insertDummyCategories', 'GeneralController::insertDummyCategories');
$routes->get('/insertDummyBrands', 'GeneralController::insertDummyBrands');
$routes->get('/insertDummyProducts', 'GeneralController::insertDummyProducts');


$routes->get('ProductView', 'ProductControllerApi::ProductView', ['namespace' => 'App\Controllers\Api']);
$routes->get('CreateNewProduct', 'Api\ProductApiController::CreateNewProduct');
$routes->group('/', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('ProdCardDisplayList', 'ProductApiController::ProdCardDisplayList');     // List
});


$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('product', 'ProductApiController::index');     // List
    $routes->get('ProdCardDisplayList', 'ProductApiController::ProdCardDisplayList');     // List
    $routes->get('FilterProdByCate', 'ProductApiController::FilterProdByCate');     // List
    $routes->get('FilterProdByBrand', 'ProductApiController::FilterProdByBrand');     // List
    $routes->get('ProductTest', 'ProductApiController::ProductTest');     // List
    $routes->get('product/(:num)', 'ProductApiController::show/$1'); // Single
    $routes->post('product', 'ProductApiController::create');        // Create ============== imp ==============
    // $routes->put('product/(:num)', 'ProductApiController::update/$1'); // Update
    $routes->post('product/(:num)', 'ProductApiController::update/$1'); // Update ============ imp =========
    $routes->delete('product/(:num)', 'ProductApiController::delete/$1'); // Delete
    $routes->get('product/searchByProductName', 'ProductApiController::searchByProductName'); // searchByProductName
    $routes->get('product/searchByProdNameCateBrand', 'ProductApiController::searchByProdNameCateBrand'); // searchByProdNameCateBrand
});

$routes->get('ShowListCategory', 'Api\ProdCategoryApiController::ShowListCategory');
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('category', 'ProdCategoryApiController::index');         // List
    $routes->get('category/(:num)', 'ProdCategoryApiController::show/$1'); // Single
    $routes->post('category', 'ProdCategoryApiController::create');        // Create
    $routes->put('category/(:num)', 'ProdCategoryApiController::update/$1'); // Update
    $routes->delete('category/(:num)', 'ProdCategoryApiController::delete/$1'); // Delete
    $routes->get('category/search', 'ProdCategoryApiController::searchCategory'); // searchCategory
});

$routes->get('BrandView', 'GeneralController::BrandView');
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->get('brand', 'ProdBrandApiController::index');         // List
    $routes->get('brand/(:num)', 'ProdBrandApiController::show/$1'); // Single
    $routes->post('brand', 'ProdBrandApiController::create');        // Create
    $routes->put('brand/(:num)', 'ProdBrandApiController::update/$1'); // Update
    $routes->delete('brand/(:num)', 'ProdBrandApiController::delete/$1'); // Delete
});
