<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

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

    public function Customers_info(){
        $info = User::all();
            return $this->success($info,'Customer information');
    }
}
