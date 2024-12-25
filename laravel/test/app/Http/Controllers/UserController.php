<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id'=>1,'name'=>"Louay"],
            ['id'=>2,'name'=>"Luna"]
        ];

        //to comment several lines ctrl+/
        // foreach ($users as $user) {
        //     echo $user['id'] . ' ' . $user['name'] . "\n";
        // }

        return response()->json($users);
        //return response()->json(["name"=>"louay"]);
        //return response_function()->json(data,status,headers)

    }
    //to accept parameter as id integer only define it in function parameters
    //public function CheckUser(int $id){}
    public function CheckUser($id){
        if($id > 10){
            return response()->json(['message' => 'Access denied .$id excceded allowed limit'], 403);
        } else
        return response()->json(['message' => 'Welcome your id is valid']);
        //return response()->json(['message' => $id]);
    }

}
