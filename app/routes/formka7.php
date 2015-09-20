<?php

$fk7 = 'FormKA7Controller';
$pr_k7 = '/dash/formka7';
//Crud Route
Route::get($pr_k7, $con . $fk7 . "@view")->before('auth');
Route::get($pr_k7 . "/viewMe", $con . $fk7 . "@viewMe")->before('auth');
Route::post($pr_k7 . "/viewYear", $con . $fk7 . "@viewYear")->before('auth');
Route::get($pr_k7 . "/detailview/{anak_id}", $con . $fk7 . "@detailView")->before('auth');

Route::get($pr_k7 . "/disposisi", $con . $fk7 . "@disposisi")->before('auth');
Route::post($pr_k7 . "/disposisiYear", $con . $fk7 . "@disposisiYear")->before('auth');


Route::get($pr_k7 . "/preaddview", $con . $fk7 . "@preAddView")->before('auth');
Route::get($pr_k7 . "/addview/{anak_id}", $con . $fk7 . "@addView")->before('auth');
Route::post($pr_k7 . "/add", $con . $fk7 . "@add")->before('auth');

Route::get($pr_k7 . '/updateview/{id}', $con . $fk7 . '@updateView')->before('auth');
Route::post($pr_k7 . '/update', $con . $fk7 . '@update')->before('auth');

Route::get($pr_k7 . '/delete/{id}', $con . $fk7 . '@delete')->before('auth');
Route::get($pr_k7 . '/search', $con . $fk7 . '@search')->before('auth');
