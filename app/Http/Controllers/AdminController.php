<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function users()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
    }

    public function boards()
    {
        return view('admin.boards');
    }
}
