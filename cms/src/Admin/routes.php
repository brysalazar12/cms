<?php

Route::group(array('module' => 'Admin', 'namespace' => 'Brysalazar12\Cms\Admin\Controllers'), function() {
	Route::get('/admin','AdminController@index');
});