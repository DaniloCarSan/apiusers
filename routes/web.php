<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () { 
    return file_get_contents(base_path('docs/api-docs.html'));
});
