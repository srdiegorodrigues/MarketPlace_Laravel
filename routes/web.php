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


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', function() {
    {
        //Disparar o evento

       return redirect()->route('home');
    }
});
Route::any('/search', 'HomeController@search')->name('home.search');
Route::get('/home/stores', 'HomeController@stores')->name('home.stores');
Route::get('/home/shipping', 'HomeController@shipping')->name('home.shipping');
Route::get('/postal_code', 'UserController@postalCode')->name('postal-code');



Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');
Route::any('stores/search', 'StoreController@search')->name('stores.search');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::post('/checkout/notification', 'CheckoutController@notification')->name('checkout.notification');

Route::prefix('cart')->name('cart.')->group(function (){

    Route::get('/', 'CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
    Route::post('productIncrement','CartController@productIncrement')->name('increment');
    Route::post('productDecrement','CartController@productDecrement')->name('decrement');
    Route::post('removeItem','CartController@removeItem')->name('remove.item');
    Route::get('deliveryAddress', 'CartController@deliveryAddress')->name('address');

});

Route::middleware(['auth'])->prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});



Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {

    Route::get('edit/{user}', 'UserController@userEdit')->name('edit');
    Route::post('update/{user}', 'UserController@userUpdate')->name('update');
    Route::get('remove/{user}', 'UserController@userRemove')->name('remove');
    Route::get('password', 'UserController@userPassword')->name('password');
    Route::get('my-profile', 'UserController@index')->name('my-profile');
    Route::post('update-password', 'UserController@updatePassword')->name('update-password');
    Route::get('pdfProfile','UserController@pdfProfile')->name('pdf.profile');
    Route::get('pdfOrders','UserController@pdfOrders')->name('pdf.orders');

});

Route::middleware(['auth'])->prefix('user.order')->name('user.order.')->group(function () {
    Route::get('my-orders', 'UserOrderController@userOrders')->name('my');
    Route::post('cancel/{pagseguro_code}', 'UserOrderController@cancelOrder')->name('cancel');
    Route::post('refund/{pagseguro_code}', 'UserOrderController@refundOrder')->name('refund');
});






Route::group(['middleware' => ['auth','access.control.manager']], function(){
    Route::prefix('manager')->name('manager.')->namespace('Manager')->group(function(){
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');



        Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');
        Route::get('orders/my','OrdersController@index')->name('orders.my');

        Route::get('stores/remove/{store}', 'StoreController@remove')->name('stores.remove');
        Route::get('products/remove/{product}', 'ProductController@remove')->name('products.remove');



        Route::get('pdfOrdersStore','OrdersController@pdfOrdersStore')->name('pdf.orders.store');
        Route::get('pdfOrderUser/{order}','OrdersController@pdfOrderUser')->name('pdf.order.user');

        Route::get('pdfProducts','ProductController@pdfProducts')->name('pdf.products');

    });

});



Route::group(['middleware' => ['auth', 'access.control.administrator']], function() {
    Route::prefix('administrator')->name('administrator.')->namespace('Administrator')->group(function () {
        Route::get('/', 'AdministratorController@index')->name('index');

        Route::get('users', 'AdminUserController@listUsers')->name('users.list');
        Route::get('user/{user}', 'AdminUserController@profileUser')->name('profile.user');
        Route::any('users/search', 'AdminUserController@search')->name('users.search');
        Route::get('remove/{user}', 'AdminUserController@userRemove')->name('user.remove');


        Route::get('products', 'AdminProductController@listProducts')->name('products.list');
        Route::any('products/search', 'AdminProductController@search')->name('products.search');
        Route::any('products/category/{slug}', 'AdminProductController@productsCategory')->name('products.category');


        Route::get('stores', 'AdminStoreController@listStores')->name('stores.list');
        Route::any('stores/search', 'AdminStoreController@search')->name('stores.search');





        Route::get('report/users','AdminUserController@pdfUsers')->name('report.users');
        Route::get('report/products','AdminProductController@pdfProducts')->name('report.products');
        Route::get('report/stores','AdminStoreController@pdfStores')->name('report.stores');

        Route::get('charts/users','GraphicController@users')->name('charts.users');

        Route::get('charts/orders','GraphicController@orders')->name('charts.orders');


        Route::resource('categories', 'CategoryController');
        Route::get('categories/remove/{category}', 'CategoryController@remove')->name('categories.remove');
        Route::get('categories', 'CategoryController@index')->name('categories.index');
        Route::post('category', 'CategoryController@category')->name('categories.category');


    });
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');

})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes();


Route::get('/model', function (){
   return \App\User::all();
});

Route::get('not', function(){});
