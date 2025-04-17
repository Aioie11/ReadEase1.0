<?php

use Illuminate\Support\Facades\Route;

Route::get('/readinglanguage', function () {
    return view('readinglanguage');
});

Route::get('/english', function () {
    return view('english');
}); 

Route::get('/filipino', function () {
    return view('filipino');
});

Route::get('/logIn', function () {
    return view('logIn');
});

Route::get('/', function () {
    return view('logIn'); // This is your homepage
});

Route::get('/login', function () {
    return view('log'); // This is your login page
});


 