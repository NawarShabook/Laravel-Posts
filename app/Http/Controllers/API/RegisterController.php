<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{

    public function login(Request $request)
    {
        /*The attempt method is normally used to handle
        authentication attempts from your application's "login" form.
        If authentication is successful,you should regenerate
        the user's session to prevent session fixation: */
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password]))
        {
            $user=Auth::user();
            $success['token']=$user->createToken('Laravel Personal Access Client')->accessToken;
            $success['name']=$user->name;
            return $this->sendResponse($success, 'user login successfully');
        }

        else
        {
            return $this->sendError('error','Unauthorised');
        }

    }

    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[

            'name' => 'required',
            'email' => 'required|email',
            'password'=> 'required',
            'c_password'=> 'required|same:password',

        ]);

        if($validator->fails())
        {
            return $this->sendError('validator errors',$validator->errors());
        }

        $input=$request->all();

        $input['password']=Hash::make($input['password']);
        //coding the password

        $user=User::create($input);

        $success['token']=$user->createToken('Laravel Personal Access Client')->accessToken;
        $success['name']=$user->name;
        return $this->sendResponse($success, 'user registered successfully');
    }
}
