<?php

return [

    'cloud_url' => env('CLOUDINARY_URL', 'cloudinary://fake_key:fake_secret@fake_cloud'), // default supaya tidak null

    'notification_url' => env('CLOUDINARY_NOTIFICATION_URL'),
    'upload_preset' => env('CLOUDINARY_UPLOAD_PRESET'),
    'upload_route' => env('CLOUDINARY_UPLOAD_ROUTE'),
    'upload_action' => env('CLOUDINARY_UPLOAD_ACTION'),

];


