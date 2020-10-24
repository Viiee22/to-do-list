<?php
    use Illuminate\Http\Request;

    Route::get('tasks', 'TaskController@index');
    Route::group(['prefix' => 'task'], function () {
        Route::post('add', 'TaskController@add');
        Route::get('edit/{id}', 'TaskController@edit');
        Route::post('update/{id}', 'TaskController@update');
        Route::delete('delete/{id}', 'TaskController@delete');
    });