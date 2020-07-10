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

// Route::get('/', function () {
//     return view('auth.login');
// });

Auth::routes();

Route::group(['middleware' => 'locale'], function () {
	Route::get('change-language/{language}', 'Template\HomeController@changeLanguage')
		->name('user.change-language');
});

/*
     * user đăng nhập
     */
Route::get('login', 'Auth\LoginController@getLogin')->name('user.showFormLogin');
Route::post('login', 'Auth\LoginController@postLogin')->name('user.login_post');
/*
     * user đăng xuất
     */
Route::get('logout', 'Auth\LogoutController@logout')->name('user.logout');

//Quên mật khẩu
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

route::get('', 'Template@welcome')->name('index');
route::get('category_room', 'Template\RoomController@category_room')->name('category_room');
route::get('detail_room/{id}', 'Template\RoomController@detail_room')->name('room.detail_room');

route::get('contact', 'Template\ContactController@view')->name('contact');

route::get('blog', 'Template@blog')->name('blog');

route::get('detail_blog', 'Template@detail_blog')->name('detail_blog');


route::get('about_us', 'Template@about_us')->name('about_us');

route::post('process_dang_nhap', 'khachhangcontroller@process_dang_nhap')->name('process_dang_nhap');

route::get('dang_xuat', 'khachhangcontroller@process_dang_xuat')->name('dang_xuat');

route::post('process_dang_ky', 'khachhangcontroller@process_dang_ky')->name('process_dang_ky');


Route::group(['prefix' => 'admin'], function () {
	/*
     * Admin đăng nhập
     */
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.showFormLogin');
	Route::post('login', 'Auth\LoginController@postLogin')->name('admin.login_post');
	/*
     * Admin đăng xuất
     */
	Route::get('logout', 'Auth\LogoutController@logout')->name('admin.logout');

	//Quên mật khẩu
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});


Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function () {
	Route::get('/', 'HomeController@index')->name('admin.dashboard');
	Route::get('/dashboard', 'HomeController@index');

	Route::get('view_all_admin', 'HomeController@view_all')->name('view_all_admin');
	Route::get('view_insert_admin', 'HomeController@view_insert')->name('view_insert_admin');
	Route::post('process_insert_admin', 'HomeController@process_insert')->name('process_insert_admin');
	Route::get('delete_admin/{id}', 'HomeController@delete')->name('delete_admin');
	Route::get('view_one_admin/{id}', 'HomeController@view_one')->name('view_one_admin');
	Route::post('process_update_admin/{id}', 'HomeController@update')->name('process_update_admin');

	Route::group(['prefix' => 'users'], function () {
		Route::get('view_all_user', 'UserController@view_all')->name('view_all_user');
		Route::get('view_insert_user', 'UserController@view_insert')->name('view_insert_user');
		Route::post('process_insert_user', 'UserController@process_insert')->name('process_insert_user');
		//Route::get('delete_user/{id}','HomeController@delete')->name('delete_admin');
		Route::get('view_one_user/{id}', 'UserController@view_one')->name('view_one_user');
		Route::post('process_update_user/{id}', 'UserController@update')->name('process_update_user');
	});

	Route::group(['prefix' => 'loai_phong'], function () {
		Route::get('', 'CateRoomController@view_all');
		Route::get('view_all_loai_phong', 'CateRoomController@view_all')->name('view_all_loai_phong');
		Route::get('view_insert_loai_phong', 'CateRoomController@view_insert')->name('view_insert_loai_phong');
		Route::post('process_insert_loai_phong', 'CateRoomController@process_insert')->name('process_insert_loai_phong');
		Route::get('delete_loai_phong/{id}', 'CateRoomController@delete')->name('delete_loai_phong');
		Route::get('view_one_loai_phong/{id}', 'CateRoomController@view_one')->name('view_one_loai_phong');
		Route::post('process_update_loai_phong/{id}', 'CateRoomController@update')->name('process_update_loai_phong');
	});

	Route::group(['prefix' => 'phong'], function () {
		Route::get('view_all_phong', 'RoomController@view_all')->name('view_all_phong');
		Route::get('view_insert_phong', 'RoomController@view_insert')->name('view_insert_phong');
		Route::post('process_insert_phong', 'RoomController@process_insert_phong')->name('process_insert_phong');
		Route::get('view_one_phong/{id}', 'RoomController@view_one')->name('view_one_phong');
		Route::post('process_update_phong/{id}', 'RoomController@update')->name('process_update_phong');
	});

	Route::group(['prefix' => 'dat_phong'], function () {
		Route::get('view_dat_phong/{id}', 'BookingController@view_dat_phong')->name('view_dat_phong');
		Route::post('view_phong', 'BookingController@view_phong')->name('view_phong');
		Route::post('dat_phong', 'BookingController@dat_phong')->name('dat_phong');
	});

	Route::group(['prefix' => 'hoa_don'], function () {
		Route::get('', 'BillController@chua_nhan_phong');
		Route::get('chua_nhan_phong', 'BillController@chua_nhan_phong')->name('chua_nhan_phong');
		Route::get('da_thanh_toan', 'BillController@da_thanh_toan')->name('da_thanh_toan');
		Route::get('dang_su_dung', 'BillController@dang_su_dung')->name('dang_su_dung');
		Route::get('xac_nhan/{bill_id}', 'BillController@xac_nhan')->name('xac_nhan');
		Route::get('dung_thue/{bill_id}', 'BillController@dung_thue')->name('dung_thue');
		Route::get('thanh_toan/{bill_id}', 'BillController@thanh_toan')->name('thanh_toan');
	});

	Route::group(['prefix' => 'contact'], function () {
		Route::get('view_all', 'ContactController@view_all')->name('contact.list');
		Route::get('view_insert_contact', 'ContactController@view_insert')->name('contact.add');
		Route::post('process_insert_contact', 'ContactController@process_insert')->name('process_insert_contact');
		Route::get('delete_contact/{id}', 'ContactController@delete')->name('delete_contact');
		Route::get('view_one_contact/{id}', 'ContactController@view_one')->name('view_one_contact');
		Route::post('process_update_contact/{id}', 'ContactController@update')->name('process_update_contact');
	});

	Route::group(['prefix' => 'thong_ke'], function () {
		Route::get('view_year', 'ChartController@orderYear')->name('view_year');
		Route::get('view_month', 'ChartController@orderMonth')->name('view_month');
	});
});
