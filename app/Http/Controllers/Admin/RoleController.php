<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Role;

class RoleController extends Controller
{
    public function findAll()
    {
        $roles = Role::all();

        return response()->json($roles);
    }
}
