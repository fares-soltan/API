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
    public function createUser(Request $request)
    {
        $Create = Users::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'user_phone' =>$request->user_phone,
            'user_add' =>$request->user_add,
            'password' =>$request->password,

        ]);
        if(!$Create){
            return $this->returnError(400,"Bad Request..");
        }
        return response() ->json($Create);


    }

    public function changePassword(Request $request)
    {
        Users::where('id','=',$request-> id) -> update(['password' => $request-> user_password]);
        return $this->returnSuccessMessage('changed Password...!');
    }
}
