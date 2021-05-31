<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RoleController extends Controller
{

    public function setRole($role)
    {
        //TODO: Set User Role
        Auth::user()->syncRoles($role);

        \Session::flash('status', 'Thanks');
        return redirect()->back();
    }
}
