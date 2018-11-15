<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'edit_profile', 'myadminpost', 'edit_profile_login', 'search_user_by_franchise', 'distribution','insert_url_data','user_master','save_work'
    ];
}
