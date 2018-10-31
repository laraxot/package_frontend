<?php
//*
//$middleware=['web'];
//$namespace=$this->getNamespace().'\Controllers';

//https://laracasts.com/discuss/channels/tips/example-on-how-to-use-multiple-locales-in-your-laravel-5-website
//http://laravel-italia.it/articoli/localizzare-un-progetto-in-laravel-53-semplicissimo-con-localization
//
//$areas_prgs=[];
/*
//Route::group(['prefix' => '{locale}', 'middleware' => $middleware, 'namespace' => $namespace]
Route::group(['prefix' => App::getLocale(),'namespace'=>$namespace,'middleware'=>$middleware], function () use ($areas_prgs) {
    //Route::resource('/', 'FrontEndController');
    Route::get('/', 'FrontEndController@index');
    //Route::get('/{locale}', 'FrontEndController@index')->where('locale', 'it|en');
    Route::get('/home', 'FrontEndController@index');
});

Route::group(['prefix' => null,'namespace'=>$namespace,'middleware'=>$middleware], function () use ($areas_prgs) {
    //Route::resource('/', 'FrontEndController');
    //Route::get('/{locale}', 'FrontEndController@index')->where('locale', 'it|en');
    //Route::get('/', 'FrontEndController@index');// move to BLOG
    Route::get('/home', 'FrontEndController@index');
    Route::get('/search', 'FrontEndController@search');
    Route::get('/sitemap', 'SitemapController@index');

    //Routes to Get TypeAhead data
    Route::get('/getPost', 'AjaxController@getPost');
    Route::get('/searchRestaurants', 'AjaxController@searchRestaurants');

});
/*/
//Route::feeds();


//*/
/*
Route::group(['prefix' =>  LaravelLocalization::setLocale(),'namespace'=>$namespace]
, function () use ($areas_prgs) {
    Route::resource('/', 'FrontEndController');
    //Route::get('/{locale}', 'FrontEndController@index')->where('locale', 'it|en');
    Route::get('/home', 'FrontEndController@index');
});
//*/


$this->routes();
