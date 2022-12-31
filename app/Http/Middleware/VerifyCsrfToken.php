<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/paytm/notify',
        '/sslcommerz/notify',
        'razorpay/notify',
        'flutterwave/notify'
    ];
}
