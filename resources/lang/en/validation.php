<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rule. Feel free to tweak each of these messages here.
    |
    */

    'email' => [
        'required' => 'Please enter your email address.',
        'email' => 'Please enter a valid email address.',
        'rfc' => 'Please enter a valid email address.',
        'dns' => 'Please enter a valid email address.',
        'max' => 'Email address must not be greater than 255 characters.',
        'unique' => 'This email address is already registered.',
    ],

    'password' => [
        'required' => 'Please enter your password.',
        'confirmed' => 'Password confirmation does not match.',
    ],

    'name' => [
        'required' => 'Please enter your full name.',
        'string' => 'Name must be a string.',
        'max' => 'Name must not be greater than 255 characters.',
    ],

];
