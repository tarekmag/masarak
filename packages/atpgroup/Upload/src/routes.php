<?php
    Route::middleware(['web' ])->group(function () {
        Route::post('upload-image','ATPGroup\Upload\Upload@upload');
        Route::post('upload-images','ATPGroup\Upload\Upload@uploads');
    });
?>
