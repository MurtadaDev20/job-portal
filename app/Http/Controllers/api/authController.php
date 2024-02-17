<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function login(Request $request)
    {
        try {
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
            {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($validator, $code);
            }

            $cred = $request->only(['email', 'password']);
            $token = Auth::guard("api")->attempt($cred);

            if (!$token)
            {
                return response()->json(['msg' => "error"]);
            }

            $user = Auth::guard("api")->user();
            $user->token = $token;

            return response()->json(['msg' =>$user]);

        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
}
