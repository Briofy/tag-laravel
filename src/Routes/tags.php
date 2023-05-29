<?php

use Briofy\Tag\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('briofy-tag.route.prefix').'/tags')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tags.index');
    Route::get('/{id}', [TagController::class, 'show'])->name('tags.show');
});
