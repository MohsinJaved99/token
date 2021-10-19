<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\counter;
use App\Models\Operator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Support\Facades\DB;
use Nexmo;
use Nexmo\Laravel\Facade\Nexmo as FacadeNexmo;

class TokenController extends Controller
{
    //

    function tokens(){
        $getuseddata = User::select("*")->where("id",session('adminid'))->get();

        $matchThese = ['counters.company_id' => session('adminid')];
        $res=counter::select("branches.address as address","counters.customer_name as customer_name","counters.customer_number as customer_number","counters.token_number as token_number","counters.token_time as token_time",DB::raw("DAY(counters.created_at) as 'day'"),DB::raw("MONTH(counters.created_at) as 'month'"),DB::raw("YEAR(counters.created_at) as 'year'"),"counters.token_price as token_price")
        ->where($matchThese)
        ->join("branches","branches.id","=","counters.branch_id")
        ->get();

        $array=array('userdata'=>$getuseddata,'branchdata'=>$res);

        return view('admin.tokens')->with('data', $array);
    }


    function deleteToken($id) {
        $counter = counter::find($id);
        $counter->delete();
        return redirect()->route('index-route');
    }

    function editToken($id) {
        $counter = counter::select("*")
        ->where("id","=",$id)
        ->get();

        $getuseddata = Operator::select("operators.name as name","users.name as company","branches.address as branch","operators.branch_id as branch_id")
            ->join('users','users.id','=','operators.created_by')
            ->join('branches','branches.id','=','operators.branch_id')
            ->where("operators.user_id",session('id'))
            ->get();
         

        $array= array('counterdata'=>$counter,'userdata'=>$getuseddata);
        return view('operator.editToken')->with('data',$array);
    }


    function updateToken(Request $req) {
        $counter = counter::find($req->id);
        $counter->customer_number=$req->customer_number;
        $counter->customer_name=$req->customer_name;
        $counter->save();
        return redirect()->route('index-route');
    }
    

    function createNewToken(Request $req) {
        $counter = new counter();
        $userdata=Operator::select("*")->where("user_id",session('id'))->get();
        // $userid=$userdata->id;
        $userbranch=$userdata[0]->branch_id;

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 15; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $matchThese = ['branch_id' => $userbranch, 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese)
        ->get();



        // dd($getcompanyid);
        $Count = $getcount->count();
        $updatecount=$Count+1;
        $counter->user_id=session('id');
        $counter->branch_id=$userbranch;
        $counter->company_id=$userdata[0]->created_by;
        $counter->customer_name=$req->customer_name;
        $counter->customer_number=$req->customer_number;
        $counter->token_time=date('H:i A');
        $counter->token_link=$randomString;
        $counter->token_price=$req->token_price;
        $counter->token_number=$updatecount;
        $counter->status="Waiting";
        $counter->save();
        // $getuseddata = User::select("*")->where("id",session('id'))->get();
        return redirect()->route('index-route');
    }

    function gettokenttl($id) {
        $matchThese = ['branch_id' => $id, 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese)
        ->get();
        $response = $getcount->count();
        if($response<10) {
            $response="0".$response;
        }
        return $response;
    }

    function getbranchtoken($id) {
        $matchThese = ['branch_id' => $id, 'created_at' => date('Y-m-d')];
        $res=counter::where($matchThese)
        ->orderBy('id','desc')
        ->get();
        $response="";
        foreach($res as $row) {
            if($row->status=="Completed") {
                $response=$response."<tr><td>".$row->customer_name."</td>"."<td>".$row->customer_number."</td>"."<td style='font-weight:bold'>".$row->token_number."</td>"."<td><a target='_blank' href='/tokenInfo/".$row->branch_id."/".$row->token_link."'>Click</a></td>"."<td>".$row->token_time."</td>"."<td>".$row->status."<td colspan='2'><button class='btn btn-success'><i class='fa fa-check'></i></button></td></tr>";
            }
            else {
                $response=$response."<tr><td>".$row->customer_name."</td>"."<td>".$row->customer_number."</td>"."<td style='font-weight:bold'>".$row->token_number."</td>"."<td><a target='_blank' href='/tokenInfo/".$row->branch_id."/".$row->token_link."'>Click</a></td>"."<td>".$row->token_time."</td>"."<td>".$row->status."<td><a href='/editToken/".$row->id."'><button class='btn btn-primary'>Edit</button></a></td><td><a href='/deleteToken/".$row->id."'><button class='btn btn-danger'>Delete</button></a></td></tr>";
            }
            
        }

        return $response;
    }

    function gettokeninfo($id, $link) {
        // $userdata = DB::table('users')
        // ->join('companies', 'users.company_id', '=', 'companies.id')
        // ->where('users.email',$req->email)
        // ->get(['users.id','users.name','users.email','users.age','users.image','companies.name as company_name','companies.address']);

        $matchThese = ['counters.token_link' => $link];
        $res=counter::select("counters.status as status","counters.token_price as token_price","counters.token_time as token_time","counters.customer_name as customer_name","counters.customer_number as customer_number","counters.token_number as tokennumber","u.name as username","branches.address as address","counters.branch_id as branchid","c.name as company")
        ->join('users as u', 'u.id', '=', 'counters.user_id')
        ->join('branches', 'branches.id', '=', 'counters.branch_id')
        ->join('users as c', 'branches.user_id', '=', 'c.id')
        ->where($matchThese)
        ->get();

        $matchThese1 = ['branch_id' => $id, 'status' => 'Completed', 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese1)
        ->get();
        $res1 = $getcount->count();
        
        // return $array["linkuserdata"];
        if($res[0]->status != "Completed"){
            if($res1<10) {
                $res1="0".$res1;
            }
            $array=array('linkuserdata'=>$res,'branchtotaltokenscompleted'=>$res1);
            return view('tokenInfo')->with('data', $array);
        }
        else {
            return view('tokenInfo')->with('data', null);
        }
       
        return ['link data'=>$res,'branch data'=>$res1];
    }

    function getActiveToken($id) {
        $matchThese1 = ['branch_id' => $id, 'status' => 'Completed', 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese1)
        ->get();
        $res1 = $getcount->count();
        if($res1<10) {
            $res1="0".$res1;
        }
        return $res1;
    }
    
    public function nextToken(Request $req) {

        // $basic  = new \Vonage\Client\Credentials\Basic("cdab9043", "78883sBy2gWPxocE");
        // $client = new \Vonage\Client($basic);

        $matchThese1 = ['branch_id' => $req->id, 'status' => 'Completed', 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese1)
        ->get();
        $res1 = $getcount->count()+1;

        // $f=['branch_id' => $req->id,'token_number' => $res1, 'created_at' => date('Y-m-d')];
        // $getcounterr=counter::select("customer_number","customer_name")
        // ->where($f)
        // ->get();

        // $nxt5=$res1+5;

        // $ff=['branch_id' => $req->id,'token_number' => $nxt5, 'created_at' => date('Y-m-d')];
        // $notifynextfifthtoken=counter::select("customer_number","customer_name")
        // ->where($ff)
        // ->get();
        // // if(count($notifynextfifthtoken)>0) {
        // // return response()->json(['success'=>$notifynextfifthtoken]);
        // // }
        // // else {
        // // return response()->json(['success'=>'not found']);

        // // }
        // if(count($notifynextfifthtoken)>0) {
        //     $response = $client->sms()->send(
        //         new \Vonage\SMS\Message\SMS($notifynextfifthtoken[0]->customer_number, "Token com", 'Hi '.$notifynextfifthtoken[0]->customer_name.', be ready your token number ('.$res1.') is reaching out shortly.')
        //             );
        // }

        // //  dd($getcounterr->customer_number);
        // //  return response()->json(['success'=>$getcounterr[0]->customer_number]);

        // $response = $client->sms()->send(
        // new \Vonage\SMS\Message\SMS($getcounterr[0]->customer_number, "Token com", 'Hi '.$getcounterr[0]->customer_name.', your token has been called. Please reach out.')
        // );

        // $message = $response->current();

        // if ($message->getStatus() == 0) {
        //     echo "The message was sent successfully\n";
        // } else {
        //     echo "The message failed with status: " . $message->getStatus() . "\n";
        // }
    
        
        $res=DB::update("update counters set status = 'Completed' where branch_id = ? and token_number = ?", [$req->id, $res1]);
        if($res>0) {
            return response()->json(['success'=>"Token Number ".$res1." Go In!"]);
        }
        else {
            return response()->json(['success'=>"Token Completed!"]);
        }
    }

    function backToken(Request $req) {
        $matchThese1 = ['branch_id' => $req->id, 'status' => 'Completed', 'created_at' => date('Y-m-d')];
        $getcount=counter::where($matchThese1)
        ->get();
        $res1 = $getcount->count();


        $res=DB::update("update counters set status = 'Waiting' where branch_id = ? and token_number = ?", [$req->id, $res1]);
        if($res>0) {

            return response()->json(['success'=>"Token Number ".$res1." Back!"]);
        }
        else {
            return response()->json(['success'=>"Token Completed!"]);
        }
    }


    public function getbranchdata($id)
    {
        $matchThese = ['company_id' => $id , 'created_at' => date('Y-m-d')];
        $res=counter::where($matchThese)
        ->orderBy('id','desc')
        ->limit(10)
        ->get();
        $response="";
        foreach($res as $row) {
            $response=$response."<tr><td>".$row->customer_name."</td>"."<td>".$row->customer_number."</td>"."<td>".$row->token_number."</td>"."<td><a target='_blank' href='http://localhost:8000/tokenInfo/".$row->branch_id."/".$row->token_link."'>Click</a></td>"."<td>".$row->token_time."</td>"."<td>".$row->status."</td></tr>";
        }

        return $response;
    }

    public function getbranchfortokenpage($id,$search) {
        $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

        $matchThese = ['counters.company_id' => $id];
        $res=counter::select("branches.address as address","counters.customer_name as customer_name","counters.customer_number as customer_number","counters.token_number as token_number","counters.token_time as token_time",DB::raw("DAY(counters.created_at) as 'day'"),DB::raw("MONTH(counters.created_at) as 'month'"),DB::raw("YEAR(counters.created_at) as 'year'"),"counters.token_price as token_price")
        ->where($matchThese)
        ->where('counters.customer_name','like','%'.$search.'%')
        ->orWhere('counters.customer_number','like','%'.$search.'%')
        ->orWhere('counters.token_time','like','%'.$search.'%')
        ->orWhere('counters.created_at','like','%'.$search.'%')
        ->orWhere('branches.address','like','%'.$search.'%')
        ->join("branches","branches.id","=","counters.branch_id")
        ->orderBy('counters.id','desc');

        $getdata=$res->get();
        $getsum=$res->sum("token_price");
        $response="";
        foreach($getdata as $row) {
            $response=$response."<tr><td>".$row->address."</td>"."<td>".$row->customer_name."</td>"."<td>".$row->customer_number."</td>"."<td style='font-weight:bold'>".$row->token_number."</td>"."<td>".$row->token_time."</td>"."<td>".$row->day."-".$months[$row->month]."-".$row->year."</td>"."<td>".$row->token_price."</td></tr>";
        }

        $array=array('response'=>$response,'sum'=>$getsum);

        return $array;
    }
}
