<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>

<style>
.dtl {
    font-size: 19px;
    font-weight: 400;
    font-family: 'calibri'
}
</style> 
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Token Status</h1>
</div>
@if ($data==null) 
    <div style="position: relative;width: 100%;height: 100%;display: flex;justify-content: center;align-items: center;flex-direction: column">
        <img src="https://media.istockphoto.com/vectors/red-rubber-stamp-icon-on-transparent-background-vector-id918699354?b=1&k=20&m=918699354&s=612x612&w=0&h=s42ZyRq1P0w4VC_u2zFWueI76peOOOOl3Fqb7WBJ2m0=" width="100px" height="100px"><br>
        <h2>Link Expired</h2>
    </div>
@else
    <div class="col-md-8 offset-md-2 rounded shadow" style="margin-top: 200px;background-color: white">
        <div class="row" style="padding: 20px">
            <div class="col-md-4" style="height: 430px;border-radius: 10px;box-shadow: 0 10px 25px rgba(0,0,0,0.25);padding:20px 20px;border: 2px solid #333;margin: 20px">
                <p style="text-align: center;font-weight: 500;font-size: 18px;margin-bottom: -20px">Active Token</p>
        
                    <h2 style="text-align: center;font-size: 8.5em" id="activetoken">
                        {{$data["branchtotaltokenscompleted"]}}
                    </h2>
                <hr>
                <p style="text-align: center;font-weight: 500;font-size: 18px;margin-bottom: -20px">Your Token</p>
                @foreach ($data["linkuserdata"] as $tkn)
                    <h2 style="text-align: center;font-size: 8.5em">
                        @if ($tkn->tokennumber<10)
                            0{{$tkn->tokennumber}}
                        @else
                            {{$tkn->tokennumber}}
                        @endif
                    </h2>
                @endforeach
            </div>
            <div class="col-md-7" style="height: 430px;border-radius: 10px;box-shadow: 0 10px 25px rgba(0,0,0,0.25);padding:20px 20px;border: 2px solid #333;margin: 20px">
                @foreach ($data["linkuserdata"] as $tkn)
                    <input type="hidden" value="{{$tkn->branchid}}" id="branchid">
                    <h2 style="text-align: center">{{$tkn->company}}</h2>
                    <h5 style="text-align: center">{{$tkn->address}}</h5>
                    <p style="float: right"><b>Time:</b> {{$tkn->token_time}}</p>
                    <p><b>Date:</b> <?php echo date("d-M-Y") ?></p>
                    <hr>
                    <h5 style="margin-bottom: 20px;text-align: center">Token Info</h5>
                        <p class="dtl"><b>Issued By:</b> {{$tkn->username}}</p>
                        <p class="dtl"><b>Name:</b> {{$tkn->customer_name}}</p>
                        <p class="dtl"><b>Contact:</b> {{$tkn->customer_number}}</p>
                        <p class="dtl"><b>Price:</b> {{$tkn->token_price}} Rs</p>
                        <p class="dtl"><b>Status:</b> {{$tkn->status}}</p>
                @endforeach
            </div>
        </div>
    </div>
    <x-footer/> 
    <x-header data=""/>
    <script>
        $( document ).ready(function() {
        var id=document.getElementById("branchid").value;
        $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        window.setInterval(function(){
        
            jQuery.ajax({
                url:'http://localhost:8000/getActiveToken/'+id,
                type: 'GET',
                data: {},
                success: function( data ){
                    $('#activetoken').html(data)
                },
                error: function () {
                    console.log("xhr=");
                }
            });
            
        }, 1000);
    });
    </script>
@endif