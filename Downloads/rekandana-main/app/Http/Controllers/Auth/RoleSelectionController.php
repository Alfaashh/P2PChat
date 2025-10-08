<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleSelectionController extends Controller
{
    public function create() {
        return view('auth.select-role');
    }
}
