<?php

use App\Admin\v1\Http\Comment\Controllers\CommentController;

Route::controller(CommentController::class)
    ->name('admin.')
    ->group(function () {
        Route::get('comment', 'index')->name('comment.index');
        Route::get('comment/{comment}', 'show')->name('comment.show');
        Route::post('comment/{comment}/approve', 'approve')->name('comment.approve');
        Route::delete('comment/{comment}', 'destroy')->name('comment.destroy');
    });
