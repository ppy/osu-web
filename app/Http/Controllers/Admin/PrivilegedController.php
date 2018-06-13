<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Auth;

abstract class PrivilegedController extends BaseController
{
    protected $section = 'admin';

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if (Auth::check() && !Auth::user()->isAdmin()) {
                if (!Auth::user()->isQAT()) {
                    if (!Auth::user()->isProjectLoved()) {
                        abort(403);
                    }
                }
            }

            return $next($request);
        });

        return parent::__construct();
    }
}
