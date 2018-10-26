<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(array('auth', 'admin-only'))
    ->namespace('Admin')
    ->group(function (){
    
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        Route::get('add-users', 'UserController@addUsers')->name('admin.add-users');
        Route::get('users/search', 'UserController@search')->name('admin.users.search');
        Route::resource('users', 'UserController', [
            'names' => [
                'index'   => 'admin.users.index',
                'create'  => 'admin.users.create',
                'store'   => 'admin.users.store',
                'show'    => 'admin.users.show',
                'edit'    => 'admin.users.edit',
                'update'  => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]
        ]);        
        
        // Routes for news
        Route::get('news', 'NewsController@index')->name('admin.news.index');
        Route::get('news/create', 'NewsController@create')->name('admin.news.create');
        Route::get('news/edit/{news}', 'NewsController@edit')->name('admin.news.edit');
        Route::post('news/store', 'NewsController@store')->name('admin.news.store');
        Route::patch('news/update{news}', 'NewsController@update')->name('admin.news.update');
        Route::get('news/destroy', 'NewsController@destroy')->name('admin.news.destroy');
    
        // Routes for pages
        Route::get('pages', 'PageController@index')->name('admin.pages.index');
        Route::get('pages/create', 'PageController@create')->name('admin.pages.create');
        Route::get('pages/edit/{page}', 'PageController@edit')->name('admin.pages.edit');
        Route::post('pages/store', 'PageController@store')->name('admin.pages.store');
        Route::patch('pages/update/{page}', 'PageController@update')->name('admin.pages.update');
        Route::get('pages/destroy', 'PageController@destroy')->name('admin.pages.destroy');
    
        // Routes for faqs
        Route::get('faqs', 'FaqController@index')->name('admin.faq.index');
        Route::get('faqs/create', 'FaqController@create')->name('admin.faq.create');
        Route::get('faqs/edit/{faq}', 'FaqController@edit')->name('admin.faq.edit');
        Route::post('faqs/store', 'FaqController@store')->name('admin.faq.store');
        Route::patch('faqs/update/{faq}', 'FaqController@update')->name('admin.faq.update');
        Route::get('faqs/destroy', 'FaqController@destroy')->name('admin.faq.destroy');
    
        // Routes for toolkit
        Route::get('toolkits', 'ToolkitController@index')->name('admin.toolkit.index');
        Route::get('toolkits/create', 'ToolkitController@create')->name('admin.toolkit.create');
        Route::get('toolkits/edit/{toolkit}', 'ToolkitController@edit')->name('admin.toolkit.edit');
        Route::post('toolkits/store', 'ToolkitController@store')->name('admin.toolkit.store');
        Route::patch('toolkits/update/{toolkit}', 'ToolkitController@update')->name('admin.toolkit.update');
        Route::get('toolkits/destroy', 'ToolkitController@destroy')->name('admin.toolkit.destroy');

        // Routes for events
        Route::get('events', 'EventController@index')->name('admin.events.index');
        Route::get('events/create', 'EventController@create')->name('admin.events.create');
        Route::get('events/edit/{Event}', 'EventController@edit')->name('admin.events.edit');
        Route::post('events/store', 'EventController@store')->name('admin.events.store');
        Route::patch('events/update/{Event}', 'EventController@update')->name('admin.events.update');
        Route::get('events/destroy/{Event}', 'EventController@destroy')->name('admin.events.destroy');
    
    
        //        Route::resource('toolkits', 'ToolkitController', [
        //            'names' => [
        //                'index'   => 'admin.toolkit.index',
        //                'create'  => 'admin.toolkit.create',
        //                'store'   => 'admin.toolkit.store',
        //                'show'    => 'admin.toolkit.show',
        //                'edit'    => 'admin.toolkit.edit',
        //                'update'  => 'admin.toolkit.update',
        //                'destroy' => 'admin.toolkit.destroy',
        //            ]
        //        ]);
        //
        //        Route::get('funeral-homes/import', 'FuneralHomeController@importExcel')->name('admin.funeral-home.import');
        //        Route::post('funeral-homes/save-import-file', 'FuneralHomeController@saveImportFile')->name('admin.funeral-home.save-import-file');
        //        Route::resource('funeral-homes', 'FuneralHomeController', [
        //            'names' => [
        //                'index'   => 'admin.funeral-homes.index',
        //                'create'  => 'admin.funeral-homes.create',
        //                'store'   => 'admin.funeral-homes.store',
        //                'show'    => 'admin.funeral-homes.show',
        //                'edit'    => 'admin.funeral-homes.edit',
        //                'update'  => 'admin.funeral-homes.update',
        //                'destroy' => 'admin.funeral-homes.destroy',
        //            ]
        //        ]);
        //
        //        Route::resource('campaigns', 'CampaignController', [
        //            'names' => [
        //                'index'   => 'admin.campaigns.index',
        //                'create'  => 'admin.campaigns.create',
        //                'store'   => 'admin.campaigns.store',
        //                'show'    => 'admin.campaigns.show',
        //                'edit'    => 'admin.campaigns.edit',
        //                'update'  => 'admin.campaigns.update',
        //                'destroy' => 'admin.campaigns.destroy',
        //            ]
        //        ]);
        //
        //        Route::resource('organisations', 'OrganizationController', [
        //            'names' => [
        //                'index'   => 'admin.organization.index',
        //                'create'  => 'admin.organization.create',
        //                'store'   => 'admin.organization.store',
        //                'show'    => 'admin.organization.show',
        //                'edit'    => 'admin.organization.edit',
        //                'update'  => 'admin.organization.update',
        //                'destroy' => 'admin.organization.destroy',
        //            ]
    
        //
        //        Route::get('settings', 'SettingsController@index')->name('admin.settings.index');
        //        Route::post('settings', 'SettingsController@store')->name('admin.settings.store');
    });