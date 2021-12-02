<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Env Variable for HTML_MINIFY
    |--------------------------------------------------------------------------
    |
    | Set this value to the false if you don't need html minify
    | this is by default "true"
    |
    */
    'default' => env('HTML_MINIFY', true),
    'replace_new_lines' => env('HTML_MINIFY_NEW_LINES', true)
];
