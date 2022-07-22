<?php
// Solution for Invalid characters passed for attempted conversion, these have been ignored
// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
error_reporting(E_ALL ^ (E_DEPRECATED));

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Frontend\FrontendController@productsView') -> name('/');
Route::get('my/contact', 'Frontend\FrontendController@contact') -> name('contact');
Route::get('my/about', 'Frontend\FrontendController@about') -> name('about');

// members
Route::get('member/login', 'Frontend\MemberController@login')->name('member.login');
Route::post('member/login-validate', 'Frontend\MemberController@loginValidate')->name('member.login-validate');
Route::post('member/logout', 'Frontend\MemberController@logout')->name('member.logout');
Route::match(['get','post'], 'forgot-password', 'Frontend\MemberController@forgotPassword')->name('frontend.forgot-password');
Route::match(['get','post'], 'password-reset/{extra_remember_token}', 'Frontend\MemberController@passwordReset')->name('frontend.password-reset');
Route::get('member/register', 'Frontend\MemberController@register')->name('member.register');
Route::post('member/register', 'Frontend\MemberController@registration')->name('member.registration');
// members

Route::get('my/product-category/{category_id}', 'Frontend\FrontendController@CategoryMenu')->name('category.menu');
Route::get('my/product-details/{id}', 'Frontend\FrontendController@productDetails')->name('customer.products.details');
Route::post('search_products/', 'Frontend\FrontendController@search_products')->name('customer.search_products');

Route::group(['middleware'=>['member']], function(){

    Route::get('member/profile', 'Frontend\MemberController@profile')->name('member.profile');
    Route::post('member/profile_update', 'Frontend\MemberController@profile_update')->name('member.profile_update');
    
    Route::get('/about', 'Frontend\FrontendController@about') -> name('about');
    /*===========================frontend routes starts here=================================*/

        Route::prefix('my')->group (function(){
            Route::get('/products/view', 'Frontend\FrontendController@productsView')->name('customer.products.view');
            
            Route::get('/view-profile', 'Frontend\FrontendController@viewProfile')->name('customer.view.profile');
            Route::get('/edit-profile/{id}', 'Frontend\FrontendController@editProfile')->name('customer.edit.profile');
            Route::POST('/update-profile', 'Frontend\FrontendController@updateProfile')->name('customer.update.profile');
            Route::get('/password-change', 'Frontend\FrontendController@changePass')->name('customer.change.pass');
            Route::POST('/update-password', 'Frontend\FrontendController@updatePass')->name('customer.update.pass');
            
        });

        Route::prefix('my/shipping')->group(function(){
            Route::get('/create','Frontend\ShippingController@create')->name('customer.shipping.create');
            Route::post('/store','Frontend\ShippingController@store')->name('customer.shipping.store');
            Route::get('/details/{id}','Frontend\ShippingController@details')->name('customer.shipping.details');
            Route::get('/delete/{id}','Frontend\ShippingController@ShippingDestroy')->name('customer.shipping.delete');
            Route::get('/edit/{id}','Frontend\ShippingController@edit')->name('customer.shipping.edit');
            Route::POST('/update/{id}','Frontend\ShippingController@update')->name('customer.shipping.update');
        });

        Route::prefix('my/cart/product')->group(function(){
            Route::get('/view','Frontend\CartController@view')->name('customer.cart.create');
            Route::POST('/add','Frontend\CartController@store')->name('customer.cart.store');
            Route::get('/add-single-product/{product_id}', 'Frontend\CartController@productStore')->name('customer.cart.product_store');
			
            Route::POST('/add-receiver','Frontend\CartController@session_set')->name('customer.cart.receiver');
            Route::get('/add-product','Frontend\CartController@session_shipping')->name('customer.cart.add');
            Route::POST('/edit','Frontend\CartController@additem')->name('customer.cart.additem');
            Route::get('/delete/{id}','Frontend\CartController@delete')->name('customer.cart.deleteitem');
            Route::get('/delete/all/{id}','Frontend\CartController@alldelete')->name('customer.cart.alldelete');
        });
        Route::prefix('my/order')->group(function(){
            
            Route::get('/view/','Frontend\OrderController@order_list')->name('customer.order.list');
            Route::POST('/payment/add','Frontend\OrderController@paymentStore')->name('customer.payment.store');
            Route::get('/details/{id}','Frontend\OrderController@order_details')->name('customer.order.details');
            Route::get('/pdf/{id}','Frontend\OrderController@order_details_pdf')->name('customer.order.details_pdf');

        });
		Route::get('/my/checkout', 'Frontend\OrderController@checkout')->name('customer.checkout');
        // frontend prev
});

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('users', 'UserController');
	Route::get('my_profile', 'UserController@my_profile')->name('my_profile');
    Route::match(['get','post'], '/cr', 'CrController@cr')->name('cr');
	

	Route::resource('categories', 'CategoryController');

	Route::resource('products', 'ProductController');	

	Route::resource('members', 'MemberController');	

	Route::resource('payments', 'PaymentController');	

	Route::resource('orders', 'OrderController');	

	Route::resource('order_details', 'OrderDetailsController');	

	Route::resource('sliders', 'SliderController');	

});
