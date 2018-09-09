<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$app->get('/key-generator', function() {
    return str_random(32);
});



$app->get('posts', 'PostsController@index');
$app->get('posts/{id_post}', 'PostsController@show');
$app->get('sports', 'SportsController@index');
$app->get('sports/{id_sport}', 'SportsController@show');
$app->get('sports/{id_sport}/{id_post}', 'PostController@show');


$app->post('auth/login', ['uses' => 'AuthController@authenticate']);


$app->group( ['middleware' => 'jwt.auth'], function() use ($app) {

		$app->group( ['prefix' => 'sports'], function() use ($app) {
			// $app->get('/create', 'SportsController@create');
			$app->post('/', 'SportsController@store');
			$app->put('/{id_sport}', 'SportsController@update');
			$app->delete('/{id_sport}', 'SportsController@destroy');
		});

		$app->group( ['prefix' => 'posts'], function() use ($app) {
			// $app->get('/create', 'PostsController@create');
			$app->post('/', 'PostsController@store');
			$app->put('/{id_post}', 'PostsController@update');
			$app->delete('/{id_post}', 'PostsController@destroy');
		});

    }
);