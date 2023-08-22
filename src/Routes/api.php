<?php

use Briofy\Tag\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('briofy-tag.routes.api.prefix').'/tags')
    ->middleware(config('briofy-tag.routes.api.middleware'))
    ->name(config('briofy-tag.routes.api.name'))->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('index');
    Route::get('/{id}', [TagController::class, 'show'])->name('show');
});
