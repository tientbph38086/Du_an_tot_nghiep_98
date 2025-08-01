<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin|admin|staff']);
    }
}