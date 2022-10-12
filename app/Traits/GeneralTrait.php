<?php

namespace App\Traits;

trait GeneralTrait
{
    public function returnError($errNum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "", $errNum = "200")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'errNum' => "400",
            'msg' => $msg,
            $key => $value
        ]);
    }


    public function returnValidationError($code = "404", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }

}
