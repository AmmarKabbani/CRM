<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use HttpResponses;
    /**
     * get all info of specific user by his id
     * @param  int $CustomerId
     */
    public function Customer_info(int $CustomerId){
        $info = User::where('id' , $CustomerId)->get();
        //check if $info has a value 
        if(json_decode($info , true)){
            return $this->success($info,'Customer information');
        }
        else{
            return $this->success('','Customer not found !');
        }
    }


    /**
     * get info of all user by 
     */
    public function Customers_info(){
        $info = User::all();
            return $this->success($info,'Customer information');
    }


    /**
     * edit  info of specific user by his id 
     * note : before use this api you should import and fill all field of info 
     * @param  int $CustomerId
     * @param  Request $request 
     */
    public function edit_customer(Request $request, int $CustomerId){
        $validator = Validator::make($request->all(), [ 
            'name' => 'string|min:5',
            'email' => 'email',
        ]
        );
        /**
         * return the error and info about it if something wrong with user input  
        */ 
        if ($validator->fails()) {
            return $validator->errors();
        }
        $Customer = User::find($CustomerId);
        if($Customer){
            if($Customer->email != $request->email){
                $Customer->update([
                    'email' =>$request->email,
                ]);
            }
            $Customer->update([
                'name' =>$request->name,
            ]);
            return $this->success('','done');
        }
    }
}
