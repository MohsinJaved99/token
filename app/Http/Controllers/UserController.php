<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Counter;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Generator\StringManipulation\Pass\Pass;


class UserController extends Controller
{

    function index() {
     
        if(!empty(session('id')) && empty(session('adminid'))) {
            $getuseddata = Operator::select("operators.name as name","users.name as company","branches.address as branch","operators.branch_id as branch_id")
            ->join('users','users.id','=','operators.created_by')
            ->join('branches','branches.id','=','operators.branch_id')
            ->where("operators.user_id",session('id'))
            ->get();
            return view('operator.index',["userdata"=>$getuseddata]);
        }
        else if(!empty(session('adminid')) && empty(session('id'))) {
            $getoperatordata = Operator::select("*")
            ->where("created_by",session('adminid'))
            ->get();
            $getuseddata = User::select("*")->where("id",session('adminid'))->get();
            $getusercount=$getoperatordata->count();
            
            $getbranchdata= Branch::select("*")->where("user_id",session('adminid'))->get();
            $getbranchcount=$getbranchdata->count();
            
            $matchThese = ['company_id' => session('adminid'), 'created_at' => date('Y-m-d')];

            $getsumoftokens=Counter::select("*")->where($matchThese)->sum("token_price");

            $arry=array("userdata"=>$getuseddata,"totaluser"=>$getusercount,"totalbranch"=>$getbranchcount,"totaltokensumoftoday"=>$getsumoftokens);
            return view('admin.index')->with('data',$arry);
        }
        else {
            return redirect('login');
        }
    }

    function profile() {
        if(!empty(session('adminid'))) {
            $getuseddata = User::select("*")->where("id",session('adminid'))->get();
        }
        else {
            $getuseddata = Operator::select("operators.id as id","operators.user_id as user_id","users.role_id as role_id","operators.name as name","operators.contact as contact","operators.cnic as cnic","users.email as email","users.password as password","users.status as status")
            ->join('users','users.id','=','operators.user_id')
            ->where("operators.user_id",session('id'))
            ->get();
        }
       
        return view('profile')->with('userdata', $getuseddata);
    }

    //
    function loginAuth(Request $req) {
        $req->validate([
            'email' => 'required | email',
            'password' => 'required | min:3'
        ]);

        // if($req->validate()) {

            $userdata=array(
                'email' => $req->email,
                'password' => $req->password
            );

            if(Auth::attempt($userdata)){
                $getusedid = User::select("*")->where("email",$req->email)->get();
                $getopid= Operator::where("user_id",$getusedid[0]->id)->get();
                // return $getopid[0]->user_id;
                if($getusedid[0]->role_id==1) {
                    $req->session()->put('adminemail',$req->email);
                    $req->session()->put('adminid',$getusedid[0]->id);
                    return redirect()->route('index-route');
                }
                else {
                    $req->session()->put('email',$req->email);
                    $req->session()->put('id',$getopid[0]->user_id);
                    return redirect()->route('index-route');
                }
            }
            else {
                return redirect()->route('login-route')->with('success','Email Or Password Do Not Match.');
            }
        // } 
    }

    public function editPassword(Request $req) {

        $req->validate([
            'old_password' => 'required',
            'password' => 'required | min:3',
            'confirm_password' => 'required | same:password'
        ]);
        if($req->role_id=="1") {
            $user=User::find($req->id);

            $oldpw=$user->password;
            $opw=Hash::make($req->old_password);
            if(Hash::check($req->old_password, $oldpw)) {
                $user->password=Hash::make($req->password);
                $user->save();
                return redirect()->route('profile-route')->with('success','Password Changed!');
            }
            else {
                return redirect()->route('profile-route')->with('success','Old Password Do Not Match.');
            }
        }
        else if($req->role_id=="2") {
            $user=User::find($req->user_id);

            $oldpw=$user->password;
            $opw=Hash::make($req->old_password);
            if(Hash::check($req->old_password, $oldpw)) {
                $user->password=Hash::make($req->password);
                $user->save();
                return redirect()->route('profile-route')->with('success','Password Changed!');
            }
            else {
                return redirect()->route('profile-route')->with('success','Old Password Do Not Match.');
            }
        }

    }

    public function editProfile(Request $req) {
        // $oldpassword=Hash::make($req->old_password);
        // $newpassword=$req->password;

        if($req->role_id=="1") {
            $user=User::find($req->id);

            $user->name=$req->name;
            $user->email=$req->email;
            $user->save();
    
            return redirect()->route('profile-route')->with('success','Profile Updated!');
        }
        else if($req->role_id=="2") {
            $user=User::find($req->user_id);

            $user->name=$req->name;
            $user->email=$req->email;
            $user->save();

            $operator = Operator::find($req->id);
            $operator->name=$req->name;
            $operator->cnic=$req->cnic;
            $operator->contact=$req->contact;
            $operator->save();

            return redirect()->route('profile-route')->with('success','Profile Updated!');
        }
        
       

        // if(!empty($oldpassword) && !empty($newpassword)){
        //     if($oldpassword==$getdata->password) {
        //         $user->password=Hash::make($req->password);
        //         $pass=1;
        //     }
        //     else {
        //         $pass=2;
        //     }
        // }

        // $user->save();
        // if($pass==0) {
        //     return redirect()->route('profile-route')->with('success','Profile Updated!');
        // }
        // else if($pass==1) {
        //     return redirect()->route('profile-route')->with('success','Profile/Password Updated!');
        // }
        // else {
        //     return redirect()->route('profile-route')->with('success','Profile Updated. Old Password Dont Match.');
        // }
        

    }
}
