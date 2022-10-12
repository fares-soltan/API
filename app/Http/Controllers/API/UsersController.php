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
    public function getUserById($id)
    {
        $Users = Users::find($id);
        if(!$Users){
            return "this user not found";
        }
        return response() ->json($Users);
    }
}
