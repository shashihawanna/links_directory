<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation used for add link description
    |--------------------------------------------------------------------------
    */

    'validate' => [
        'url' => 'Please Enter URL.',
        'title' => 'Please Enter Title.',
        'description' =>  'Please Enter Description.',
        'enable' => 'Please select enable checkbox.',
        'vurl' => 'Enter valid Url',
        'eurl' => 'URL already exists',
        'nurl' => 'URL not exist' ,
        'rurl' => 'Entered URL validated successfully',
    ],
    'msg' => [
        'add_success' => 'URL Details Added Successfully',
        'details_not_found' => 'URL Details Not Found',
        'add_failed' => 'URL Details Adding Failed',
        'enter_all' => "Enterd all Details",
    ]
];
