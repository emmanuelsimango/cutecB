<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required',
            'c_password'=>'required|same:password',
            'employee_id'=>'required',
            'user_type'=>'required'
        ]);

        if ($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token']=$user->createToken('CUTEC')->accessToken;
        $success['name']= $user->name;

        return response()->json(["success"=>$success], $this->successStatus);
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success'=>$user], $this->successStatus);
    }

    public function login( )
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('CUTEC')->accessToken;
            $success['user_type']= $user->user_type;
            return response()->json(['success'=>$success], $this->successStatus);
        } else {
            # code...
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }



}
