<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //use GeneralTrait;
    public function index()
    {
        $Users = Users::get();

        return response() ->json($Users);
    }
}
