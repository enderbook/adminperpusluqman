<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginCT extends Controller
{
    public function adminLogin() {
        return redirect('/admin');
    }
}
