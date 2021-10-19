<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    //This IS REST Api Controller

    public function getUsers() {
        $user=new User;
        $userdata=$user->all();
        return $userdata;
    }

    public function getUsersById($id) {
        $user=new User;
        $userdata=$user->find($id);
        return $userdata;
    }

    public function updateUserName(Request $req, $id) {
        $user=User::find($id);
        $uname=$user->name;
        $user->name=$req->name;
        $user->save();
        return "User ID : ".$id." Name Updated!\nOld Name:".$uname."\nNew Name:".$req->name;
    }
    

}
