<?php

Route::group([
    'as' => 'client.',
    'namespace' => 'Client'
], function () {
    Route::get('/', 'HomeController@index')->name('index');

    Route::group([
        'as' => 'collection.',
        'prefix' => 'collection'
    ], function () {
        Route::get('exhibit/{exhibit}', 'CollectionsController@show')->name('show');
        Route::get('{section}/{child_section?}', 'CollectionsController@index')->name('index');
    });

    Route::group([
        'as' => 'blog.',
        'prefix' => 'blog'
    ], function () {
        Route::get('/', 'BlogController@index')->name('index');
        Route::get('{post}', 'BlogController@show')->name('show');
    });

    Route::group([
        'as' => 'exhibitions.',
        'prefix' => 'exhibitions'
    ], function () {
        Route::get('/', 'ExhibitionsController@index')->name('index');
        Route::get('{exhibition}', 'ExhibitionsController@show')->name('show');
    });

    Route::group([
        'as' => 'contacts.',
        'prefix' => 'contacts'
    ], function () {
        Route::get('/', 'ContactsController@index')->name('index');
    });

    Route::post('search', 'SearchController@index')->name('search.index');

    Route::get('{locale?}', 'LocalesController')
        ->where('locale', '('.implode('|', config('app.locales')).')');

    Route::get('{page}/{subpage?}', 'PagesController@show')
        ->where('page', '(about|book|expertise)');
});