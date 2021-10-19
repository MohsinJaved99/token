<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function operators(){
        $getuseddata = User::select("*")->where("id",session('adminid'))->get();

        $getoperatordata = Operator::select("operators.id as id","operators.name as name","users.email as email","operators.contact as contact",DB::raw("DAY(operators.created_at) as 'day'"),DB::raw("MONTH(operators.created_at) as 'month'"),DB::raw("YEAR(operators.created_at) as 'year'"),"users.status as status","branches.address as address")
        ->join('users','operators.user_id','=','users.id')
        ->join('branches','operators.branch_id','=','branches.id')
        ->where('branches.user_id',session('adminid'))
        ->get();

        $getallbranches=Branch::select("*")->where("user_id",session('adminid'))->get();

        $array=array('userdata'=>$getuseddata,'operatordata'=>$getoperatordata,'branches'=>$getallbranches);
        
        //return $getoperatordata;
        return view('admin.operators')->with('data', $array);
    }


    public function branches() {
        $getuseddata = User::select("*")->where("id",session('adminid'))->get();

        $getbranchddata = Branch::select("id as id","address as addreess","contact as contaact",DB::raw("DAY(created_at) as 'day'"),DB::raw("MONTH(created_at) as 'month'"),DB::raw("YEAR(created_at) as 'year'"),"status as status")
        ->where("user_id",session('adminid'))
        ->get();

        $array=array('userdata'=>$getuseddata,'branchdata'=>$getbranchddata);

        return view('admin.branches',compact('getbranchddata'))->with('data', $array);
    }


    public function geteditBranch($id) {
        $getuseddata = User::select("*")->where("id",session('adminid'))->get();
        $getbranchddata = Branch::find($id);
        $array=array('userdata'=>$getuseddata,'branchdata'=>$getbranchddata);
        
        return view('admin.editBranch')->with('data', $array);
    }

    public function createBranch(Request $req) {
        $branch=new Branch();
        $branch->address=$req->address;
        $branch->contact=$req->contact;
        $branch->user_id=session('adminid');
        $branch->status='Active';
        $branch->save();
        return redirect()->route('branch-route')->with('success','New Branch Created!');
    }

    public function editBranch(Request $req) {
        $branch= Branch::find($req->id);
        $branch->address=$req->address;
        $branch->contact=$req->contact;
        $branch->status=$req->status;
        $branch->save();
        return redirect()->route('branch-route')->with('success','Branch Data Updated!');
    }

    public function deleteBranch($id) {
        $branch= Branch::find($id);
        $branch->status='Inactive';
        $branch->save();
        return redirect()->route('branch-route')->with('success','Branch Inactivated!');
    }

    public function createOperator(Request $req) {
        $user=new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->role_id=2;
        $user->status='Active';
        $user->save();

        
        $operator=new Operator();
        $operator->name=$req->name;
        $operator->cnic=$req->cnic;
        $operator->contact=$req->contact;
        $operator->user_id=$user->id;
        $operator->branch_id=$req->branch_id;
        $operator->created_by=session('adminid');
        $operator->save();

        return redirect()->route('operator-route')->with('success','New Operator Created!');
    }


    public function deleteOperator($id) {
        $branch= User::find($id);
        $branch->status='Inactive';
        $branch->save();
        return redirect()->route('operator-route')->with('success','Operator Inactivated!');
    }

    public function activeOperator($id) {
        $branch= User::find($id);
        $branch->status='Active';
        $branch->save();
        return redirect()->route('operator-route')->with('success','Operator Activated!');
    }


}
