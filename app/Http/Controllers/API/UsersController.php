<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\API\Users;
use App\Traits\GeneralTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);  //generate token

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $user = Auth::guard('user-api')->user();
            $user ->api_token = $token;
            //return token
            return $this->returnData('user', $user);  //return json response

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }





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
