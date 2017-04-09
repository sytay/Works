<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT

  Route::get('site', [
  'as' => 'site',
  'uses' => 'Works\Controllers\Front\SampleFrontController@index'
  ]); */
/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {


        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/work_category', [
            'as' => 'admin_work_category',
            'uses' => 'Works\Controllers\Admin\WorkCategoryController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/work_category/edit', [
            'as' => 'admin_work_category.edit',
            'uses' => 'Works\Controllers\Admin\WorkCategoryController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/work_category/edit', [
            'as' => 'admin_work_category.post',
            'uses' => 'Works\Controllers\Admin\WorkCategoryController@post'
        ]);
        /**
         * delete
         */
        Route::get('admin/work_category/delete', [
            'as' => 'admin_work_category.delete',
            'uses' => 'Works\Controllers\Admin\WorkCategoryController@delete'
        ]);

        Route::get('storage/images/{file}', ['as' => 'file_preview', 'uses' => 'Works\Controllers\Admin\AdminController@preview']);


        /**
         * list
         */
        Route::get('admin/work', [
            'as' => 'admin_work',
            'uses' => 'Works\Controllers\Admin\WorkController@index'
        ]);
        /**
         * edit-add
         */
        Route::get('admin/work/edit', [
            'as' => 'admin_work.edit',
            'uses' => 'Works\Controllers\Admin\WorkController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/work/edit', [
            'as' => 'admin_work.post',
            'uses' => 'Works\Controllers\Admin\WorkController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/work/delete', [
            'as' => 'admin_work.delete',
            'uses' => 'Works\Controllers\Admin\WorkController@delete'
        ]);

        Route::get('admin/work/templates/{name}', [
            'as' => 'work_template',
            'uses' => 'Works\Controllers\Admin\TemplateController@templates'
        ]);
    });
});
