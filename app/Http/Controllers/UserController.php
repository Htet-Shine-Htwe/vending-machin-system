<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserController extends Controller
{
    public function index()
    {
        $users = User::
        role(enum_value(RoleEnum::USER))
        ->paginate(5)
        ->withQueryString();

        return view('portal.users.index', compact('users'));
    }
}
