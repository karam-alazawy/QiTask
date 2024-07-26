<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProjectList;
use App\Http\Livewire\TaskList;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');
    Route::get('/tasks', TaskList::class)->name('tasks');
    Route::get('/projects', ProjectList::class)->name('projects');
});


