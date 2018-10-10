<?php
Auth::routes();
Route::get('/test', function(){
    return view('email.new_account');
});
/* ----------------------------------------------------------------------------------------------
    WEB ROUTES
-------------------------------------------------------------------------------------------------*/
Route::group(['namespace'=>'Web'], function($routes){
    $routes->group(['namespace'=>'Home'], function($routes){
        $routes->get('/', 'HomeController@index')->name('welcome');
    });

    $routes->group(['namespace'=>'Category'], function($routes){
        $routes->get('/category/{ref_id}', 'CategoryController@index')->name('web.category.product');
        $routes->get('/category/{ref_id}/{sort}/{filter}', 'CategoryController@filter')->name('web.category.product.filter');

        $routes->get('/best-sell', 'CategoryController@bestSell')->name('web.best.sell');
        $routes->get('/popular-categories', 'CategoryController@popularCategories')->name('web.popular.categories');
        $routes->get('/special-offers', 'CategoryController@specialOffers')->name('web.special.offers');
    });

    $routes->group(['namespace'=>'Order'], function($routes){
        $routes->get('/item/{category}/{product}', 'OrderController@show')->name('single.product.show');
        $routes->post('/item/order/{product}', 'OrderController@store')->name('new.product.order');
    });

    $routes->group(['namespace' => 'Contact'], function($routes){
        $routes->get('/contact-us', 'ContactController@index')->name('web.contact.us');
        $routes->post('/contact-us/submit', 'ContactController@store')->name('web.contact.us');
    });
});

/* -----------------------------------------------------------------------------------------------
    USER ROUTES
--------------------------------------------------------------------------------------------------*/
Route::group(['middleware'=>['auth', 'prevent-back-history'], 'namespace'=>'User'], function($routes){
    // General Related Routes
    $routes->get('/get-notification', 'GeneralController@getNotification')->name('user.get.notification');
    $routes->get('/all-notification', 'GeneralController@getAllNotification')->name('user.get.all.notification');
    $routes->get('/read-notification', 'GeneralController@readNotification')->name('user.read.notification');
    // User Dashboard Related Routes
    $routes->group(['namespace'=>'Dashboard'], function($routes){
        $routes->get('/home', 'DashboardController@index')->name('home');
        $routes->get('/profile', 'ProfileController@index')->name('user.profile');
    });
    // User Product Related Routes
    $routes->group(['prefix'=>'/product', 'namespace'=>'Product'], function($routes){
        $routes->get('/', 'ProductController@index')->name('user.product');
        $routes->get('/create', 'ProductController@create')->name('user.product.create');
        $routes->post('/store', 'ProductController@store')->name('user.product.store');
        $routes->get('/show/{product}', 'ProductController@show')->name('user.product.show');
        $routes->delete('/delete/{product}', 'ProductController@delete')->name('user.product.delete');
        $routes->get('/edit/{type}/{product}', 'ProductController@edit')->name('user.product.edit');
        $routes->post('edit/general-details/{product}', 'ProductController@generalDetails')->name('user.product.edit.general.details');
        $routes->post('edit/product-details/{product}', 'ProductController@productDetails')->name('user.product.edit.product.details');
        $routes->delete('edit/product-image/{image}/{product}', 'ProductController@productImageDelete')->name('user.product.image.delete');
        $routes->post('edit/product-image/{product}', 'ProductController@productImage')->name('user.product.image.edit');
        $routes->post('edit/product-special-features/{product}', 'ProductController@productSpecialFeatures')->name('user.product.special.features.edit');
        $routes->post('edit/product-price/{product}', 'ProductController@productPrice')->name('user.product.price');
    });
    // User Order Related Routes
    $routes->group(['prefix'=>'/orders', 'namespace'=>'Order'], function($routes){
        $routes->get('/', 'OrderController@index')->name('user.order');
        $routes->get('/status', 'OrderController@status')->name('user.order.status');
        $routes->delete('/delete/{order}', 'OrderController@delete')->name('user.order.delete');
        $routes->get('/show/{order}', 'OrderController@show')->name('user.order.show');
        $routes->post('status/{status}/{order}', 'OrderController@orderStatus')->name('user.order.reject.status');
        $routes->post('accept/status/{status}/{order}', 'OrderController@orderStatus')->name('user.order.accept.status');

        $routes->get('/product/{product}', 'OrderController@productOrder')->name('user.product.order');
        $routes->post('/product/{product}', 'OrderController@productOrder')->name('user.product.order.all');
    });
    // user Bid Related Routes
    $routes->group(['namespace'=>'Bid'], function($routes){
        $routes->get('/bid', 'BidController@index')->name('user.bid');
        $routes->post('/bid/data', 'BidController@index')->name('user.bid.all');
        $routes->get('/buy-bid', 'BidController@create')->name('user.bid.create');
        $routes->post('/bid/store', 'BidController@store')->name('user.bid.store');
        $routes->get('/bid/show/{bid}', 'BidController@show')->name('user.bid.show');
        $routes->get('/bid/bid-rang', 'BidController@bidRang')->name('user.bid.rang');
        $routes->post('/bid/bid-rang/data', 'BidController@bidRang')->name('user.bid.rang.data');
        $routes->patch('/bid/update/{bid}', 'BidController@update')->name('user.bid.update');
    });
    // User Settings Related Routes
    $routes->group(['namespace'=>'Setting'], function($routes){
        $routes->get('/edit-profile', 'SettingController@editProfile')->name('user.edit.profile');
        $routes->post('/edit-profile_submit', 'SettingController@editProfileSubmit')->name('user.edit.profile.submit');
        $routes->get('/upload-logo', 'SettingController@uploadLogo')->name('user.upload.logo');
        $routes->post('/upload-logo_submit', 'SettingController@uploadLogoSubmit')->name('user.upload.logo.submit');
        $routes->get('/edit-aboutus', 'SettingController@editAboutUs')->name('user.edit.about.us');
        $routes->post('/edit-aboutus-submit', 'SettingController@editAboutUsSubmit')->name('user.edit.about.us.submit');
        $routes->get('/change-password', 'SettingController@changePassword')->name('user.change.password');
        $routes->post('/change-password-submit', 'SettingController@changePasswordSubmit')->name('user.change.password.submit');
    });
});

/* -----------------------------------------------------------------------------------------------
    ADMIN ROUTES
--------------------------------------------------------------------------------------------------*/
Route::get('/admin', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin', 'Admin\AdminLoginController@login')->name('admin.login.submit');
Route::group(['prefix' => '/admin', 'middleware' => ['auth:admin', 'prevent-back-history'], 'namespace'=>'Admin'], function($routes){
    // Admin General Related Routes
    $routes->get('/get-notification', 'GeneralController@getNotification')->name('admin.get.notification');
    $routes->get('/all-notification', 'GeneralController@getAllNotification')->name('admin.get.all.notification');
    $routes->get('/read-notification', 'GeneralController@readNotification')->name('admin.read.notification');

    $routes->group(['namespace'=>'Dashboard'], function($routes){
        $routes->get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    });
    // Admin Product Related Routes
    $routes->group(['prefix'=>'/product', 'namespace'=>'Product'], function($routes){
        $routes->get('/', 'ProductController@index')->name('admin.product');
        $routes->get('/show/{product}', 'ProductController@show')->name('admin.product.show');
        $routes->patch('/status/{status}/{product}', 'ProductController@status')->name('admin.product.status');

        $routes->get('/categories', 'CategoryController@index')->name('admin.category');
        $routes->post('/categories', 'CategoryController@store')->name('admin.category.store');
        $routes->post('/sub-category', 'CategoryController@storeSubCategory')->name('admin.sub.category.store');
    });
    // Admin Order Related Routes
    $routes->group(['prefix'=>'/order', 'namespace'=>'Order'], function($routes){
        $routes->get('/', 'OrderController@index')->name('admin.order');
        $routes->get('/show/{order}', 'OrderController@show')->name('admin.order.show');

        $routes->get('/product/{product}', 'OrderController@productOrder')->name('admin.product.order');
        $routes->post('/product/{product}', 'OrderController@productOrder')->name('admin.product.order.all');
    });
    // Admin Bid Related Routes
    $routes->group(['prefix'=>'/bid', 'namespace'=>'Bid'], function($routes){
        $routes->get('/', 'BidController@index')->name('admin.bid');
        $routes->post('/data', 'BidController@index')->name('admin.bid.all');
        $routes->get('/show/{bid}', 'BidController@show')->name('admin.bid.show');
        $routes->patch('/accept/{bid}', 'BidController@bidAccept')->name('admin.bid.accept');
        $routes->patch('/reject/{bid}', 'BidController@bidReject')->name('admin.bid.reject');

        $routes->get('/bid-rang', 'BidController@bidRang')->name('admin.bid.rang');
        $routes->post('/bid-rang/data', 'BidController@bidRang')->name('admin.bid.rang.data');
        $routes->get('/bid-rang/create', 'BidController@create')->name('admin.bid.rang.create');
        $routes->post('/bid-rang/store', 'BidController@store')->name('admin.bid.rang.store');
        $routes->get('/edit/{bid}', 'BidController@edit')->name('admin.bid.edit');
        $routes->post('update/{bid}', 'BidController@update')->name('admin.bid.rang.update');
    });
    // Admin Users Related Routes
    $routes->group(['prefix'=>'/users', 'namespace'=>'User'], function($routes){
        $routes->get('/', 'UserController@index')->name('admin.user.index');
        $routes->post('/data', 'UserController@index')->name('admin.user.all');
        $routes->get('/create', 'UserController@create')->name('admin.user.create');
        $routes->post('/store', 'UserController@store')->name('admin.user.store');
        $routes->get('/show/{user}', 'UserController@show')->name('admin.user.show');
        $routes->post('/reset-password', 'UserController@resetPassword')->name('admin.user.reset.password');
    });

    // Admin Settings Related Routes
    $routes->group(['prefix'=>'setting', 'namespace'=>'Setting'], function($routes){
        $routes->get('/slider', 'SliderController@index')->name('admin.slider.index');
        $routes->post('/slider', 'SliderController@store')->name('admin.slider.store');
        $routes->post('/slider/{slider}', 'SliderController@delete')->name('admin.slider.delete');
    });
});