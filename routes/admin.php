<?php
// admin route 

use Illuminate\Support\Facades\Route;


Route::middleware(['roleadmin', 'auth'])
    ->prefix('admin')
    ->group(function () {
        // dashboard group
    });
