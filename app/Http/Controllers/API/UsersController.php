<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Users;
use App\Traits\GeneralTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use GeneralTrait;
    public function index(){
        $Users = Users::get();

        return $this->returnData('Users',$Users);
    }

    public function getUserById($id){
        $User = Users::find($id);
        if(!$User){
            return $this->returnError(404,"Bad Request..");
        }
        return $this->returnData('User',$User);
    }

    public function createUser(Request $request){
        try{ $Create=Users::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'user_phone' =>$request->user_phone,
            'user_add' =>$request->user_add,
            'password' =>$request->password,

        ]);}
        catch (QueryException $e){
            return $this->returnError(404,$e->getMessage());
        }

        return $this->returnData('User',$Create,'User Created...');
    }

    public function changePassword(Request $request){
        Users::where('id','=',$request-> id) -> update(['password' => $request-> password]);
        return $this->returnSuccessMessage('changed Password...!');
    }
}
