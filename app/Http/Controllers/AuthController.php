<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use HttpResponses;

    /**
     * register a new user
     * @param Request $request
     */
    public function register(Request $request)
    {
        
        // validation on user input
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|confirmed|min:8',
        ]
        );
        /**
         * return the error and info about it if something wrong with user input  
        */ 
        if ($validator->fails()) {
            return $validator->errors();
        }

        /**
         * store user info in DB
         */
        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success('','Registered Successfully');
    }

    public function login(Request $request)
    {
        // validation on user input
        $validator = Validator::make($request->all(), [ 
            'email' => 'required',
            'password' => 'required',
        ]);

        /**
         * return the error and info about it if something wrong with user input  
        */ 
        if ($validator->fails()) {
            return $validator->errors();
        }

        // Check if the username and password match in Database 
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Success
            $userInfo = Customer::where('email',$request->email)->get();
            return $this->success($userInfo,'Logged in Successfully');
        } else {
            // fail
            return $this->error('The email or password you’ve entered is incorrect',403);
        }
    }
}