<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download/{filename}', function ($filename) {
    $filePath = public_path('files/' . $filename); 
    if (file_exists($filePath)) {
        return response()->download($filePath);
    }
});

Route::get('/{pathMatch}', function() {
    return view('welcome');
})->where('pathMatch','.*');