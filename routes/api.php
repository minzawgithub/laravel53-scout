<?php

use Illuminate\Http\Request;
use TeamTNT\TNTSearch\Support\Highlighter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users', function (Request $request) {
	$query = $request->q;
	$rawResult = App\User::search($query)->get();

	return $rawResult->map(function($each) use ($query){
		$hl = new Highlighter;
		return [
			'name' => $hl->highlight($each['name'], $query, 'em', ['wholeWord' => false]),
			'email' => $hl->highlight($each['email'], $query, 'em', ['wholeWord' => false])
		];
	});
});


