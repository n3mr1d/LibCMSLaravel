<?php
// admin route 

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;


Route::middleware(['roleadmin','auth'])
->prefix('admin')
->group(function () {
    // dashboard group
   Volt::route('/dashboard','admin.dashboard')->name('admin.dashboard');



   
});