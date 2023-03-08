<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * get all info of specific user by his id
     * @param  int $CustomerId
     */
    public function Customer_info(int $CustomerId){
        $info = Customer::where('id' , $CustomerId)->get();
        //check if $info has a value 
        if(json_decode($info , true)){
            return $this->success($info,'Customer information');
        }
        else{
            return $this->success('','Customer not found !');
        }
    }

    public function Customers_info(){
        $info = Customer::all();
            return $this->success($info,'Customer information');
    }
}
