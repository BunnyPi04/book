<?php
Auth::routes();
Route::auth();

Route::get('/', 'IndexController@index');
Route::get('/admin/test', function () {
	$rt = new App\Book;
    $tasks = $rt->where('book_id', 1)->first()->sku;
    dd($tasks);
});

Route::post('login/', 'LoginController@postLogin')->name('post_login');
Route::get('logout/', 'LoginController@logout')->name('get_logout');

Route::get('admin/', 'Backend\AdminController@index');
//book
Route::get('book/show/{book_id}', 'IndexController@show');

Route::get('admin/book', 'Backend\BooksController@list');
Route::get('admin/book/show/{book_id}', 'Backend\BooksController@show');
Route::get('admin/book/add/', 'Backend\BooksController@getAdd');
Route::post('admin/book/add/', 'Backend\BooksController@postAdd');
Route::get('admin/book/edit/{book_id}', 'Backend\BooksController@getEdit');
Route::post('admin/book/edit/{book_id}', 'Backend\BooksController@postEdit');
Route::post('admin/book/edit/', 'Backend\BooksController@list');
Route::get('admin/book/delete/{book_id}', 'Backend\BooksController@delete');

//new_book
Route::get('admin/new_book', 'Backend\NewBookController@list');
Route::get('admin/new_book/add', 'Backend\NewBookController@add');
Route::post('admin/new_book/add', 'Backend\NewBookController@save');
//hightlight_book
Route::get('admin/hightlight_book', 'Backend\HightlightBookController@list');
Route::get('admin/hightlight_book/add', 'Backend\HightlightBookController@add');
Route::post('admin/hightlight_book/add', 'Backend\HightlightBookController@save');
//store
Route::get('admin/store', 'Backend\StoresController@list');
Route::get('admin/store/add/', 'Backend\StoresController@getAdd');
Route::post('admin/store/add/', 'Backend\StoresController@postAdd');
Route::get('admin/store/edit/{store_id}', 'Backend\StoresController@getEdit');
Route::post('admin/store/edit/{store_id}', 'Backend\StoresController@postEdit');
Route::post('admin/store/delete/{store}', 'Backend\StoresController@delete');
//User
Route::get('admin/user/', 'UsersController@list');
Route::get('admin/user/add/', 'UsersController@getAdd');
Route::post('admin/user/add/', 'UsersController@postAdd');
Route::get('admin/user/info/{id}', 'UsersController@show');
Route::post('admin/user/info/{id}', 'UsersController@postEdit');
Route::post('admin/user/delete/{id}', 'UsersController@delete');
//publisher
Route::get('admin/publisher/', 'Backend\PublishersController@list');
Route::get('admin/publisher/add/', 'Backend\PublishersController@getAdd');
Route::post('admin/publisher/add/', 'Backend\PublishersController@postAdd');
Route::get('admin/publisher/edit/{publisher_id}', 'Backend\PublishersController@getEdit');
Route::post('admin/publisher/edit/{publisher_id}', 'Backend\PublishersController@postEdit');
Route::post('admin/publisher/delete/{publisher_id}', 'Backend\PublishersController@delete');
//category
Route::get('admin/category/', 'Backend\CategoriesController@list');
Route::get('admin/category/add/', 'Backend\CategoriesController@getAdd');
Route::post('admin/category/add/', 'Backend\CategoriesController@postAdd');
Route::get('admin/category/edit/{category_id}', 'Backend\CategoriesController@getEdit');
Route::post('admin/category/edit/{category_id}', 'Backend\CategoriesController@postEdit');
Route::post('admin/category/delete/{category}', 'Backend\CategoriesController@delete');
//book_value
Route::get('admin/book_value/', 'Backend\BookValueController@list');
Route::get('admin/book_value/add', 'Backend\BookValueController@getAdd');
Route::post('admin/book_value/add', 'Backend\BookValueController@postAdd');
Route::get('admin/book_value/edit/{id}', 'Backend\BookValueController@getEdit');
Route::post('admin/book_value/edit/{id}', 'Backend\BookValueController@postEdit');
Route::post('admin/book_value/delete/{id}', 'Backend\BookValueController@delete');
//coupon
Route::get('admin/coupon/', 'Backend\CouponsController@list');
Route::get('admin/coupon/add', 'Backend\CouponsController@getAdd');
Route::post('admin/coupon/add', 'Backend\CouponsController@postAdd');
Route::get('admin/coupon/edit/{id}', 'Backend\CouponsController@getEdit');
Route::post('admin/coupon/edit/{id}', 'Backend\CouponsController@postEdit');
Route::post('admin/coupon/delete/{id}', 'Backend\CouponsController@delete');
//invoice
Route::get('/admin/invoice/', 'Backend\InvoiceController@list');
Route::get('/admin/invoice/create', 'Backend\InvoiceController@create');
Route::post('/admin/invoice/create', 'Backend\InvoiceController@save');
Route::get('/admin/invoice/show', 'Backend\InvoiceController@show');
Route::get('/admin/invoice/delete/{$id}', 'Backend\InvoiceController@delete');

Route::get('/home', 'IndexController@index');
Route::get('/category/{id}', 'IndexController@category');
Route::get('/cart/addi/{id}', 'CartController@add');
Route::get('/cart/add/{id}', 'CartController@addItem');
Route::get('/cart/destroy/', 'CartController@resetCart');

Route::get('/tesform/', function() {
	return view('form_page1');
});