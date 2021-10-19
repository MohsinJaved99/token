<x-head/>
<style>
    .box {
        width: 300px;background-color: rgb(218, 218, 218);height: 150px;border-radius: 10px 20px 60px 10px;box-shadow: 0 10px 20px rgba(0,0,0,0.15);margin: 20px;justify-content: center;align-items: center;display: flex;flex-direction: column
    }
    .boxx {
        justify-content: center;align-items: center;display: flex
    }

    .box h3 {
        font-family: 'calibri'
    }
    .box p {
        font-size: 4em;font-weight: 500
    }
</style>

<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>

<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Dashboard</h1>
</div>




<input type="hidden" value="{{session('adminid')}}" id="companyid">
<div class="offset-md-1 col-md-10 rounded shadow" style="background-color: rgb(255, 255, 255);height: auto;margin-top: 200px;padding: 20px; margin-bottom: 100px">
    <div class="row">
        <div class="col-md-12">
            @foreach ($data['userdata'] as $user)
                <h2 style="text-align: center;text-transform: uppercase">{{$user->name}}</h2>
            @endforeach
        </div>
    </div>
    <div class="row boxx">
        <div class="col-md-3 shadow rounded" style="border-left: 10px solid rgb(0, 60, 139);background-image: linear-gradient(to right, rgb(11,84,182) , #27b7fe);padding: 30px 20px 10px;color: white;margin:20px">
            <h3 style="font-family: monospace">Total Operators</h3>
            <p style="font-size: 3em;font-weight: 500">{{$data['totaluser']}}</p>
            <i class="fa fa-user" style="font-size: 8em;position: absolute;color: rgba(255,255,255,0.15);bottom: 10px;right: 10px"></i>
        </div>

        <div class="col-md-3 shadow rounded" style="border-left: 10px solid rgb(0, 60, 139);background-image: linear-gradient(to right, rgb(11,84,182) , #27b7fe);padding: 30px 20px 10px;color: white;margin:20px">
            <h3 style="font-family: monospace">Total Branches</h3>
            <p style="font-size: 3em;font-weight: 500">{{$data['totalbranch']}}</p>
            <i class="fa fa-code-branch" style="font-size: 8em;position: absolute;color: rgba(255,255,255,0.15);bottom: 10px;right: 10px"></i>
        </div>


        <div class="col-md-3 shadow rounded" style="border-left: 10px solid rgb(0, 60, 139);background-image: linear-gradient(to right, rgb(11,84,182) , #27b7fe);padding: 30px 20px 10px;color: white;margin:20px">
            <h3 style="font-family: monospace">Total Collection</h3>
            <p style="font-size: 3em;font-weight: 500">{{$data['totaltokensumoftoday']}}<span style="font-size: 18px">Rs.</span></p>
            <i class="fa fa-dollar-sign" style="font-size: 8em;position: absolute;color: rgba(255,255,255,0.15);bottom: 10px;right: 10px"></i>
        </div>
      
    </div>

    <div class="row">
        <div class="col-md-12" style="margin-top: 30px;height: auto;">
            <h4 style="text-align: center">Today Tokens</h4>
            <table class="table table-hover table-striped table-bordered table-responsive-md">
                <thead class="">
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Number</th>
                    <th>link</th>
                    <th>Time</th>
                    <th>Status</th>
                </thead>
                <tbody id="tabledata">
                    <tr><td colspan="6">Loading Data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<x-footer/> 
@foreach ($data['userdata'] as $user)
<x-header data="{{$user->name}}"/> 
@endforeach


<script>
    
    $( document ).ready(function() {
        var id=document.getElementById("companyid").value;
        $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        window.setInterval(function(){
           
        
            jQuery.ajax({
                url:'getBranchData/'+id,
                type: 'GET',
                data: {},
                success: function( data ){
                    if(data!=""){
                        $('#tabledata').html(data);
                    }
                    else {
                        $('#tabledata').html("<tr><td colspan='6' style='text-align:center'>No Token Entry Found</td></tr>");
                    }
                },
                error: function () {
                    console.log("xhr=");
                }
            });

            
        }, 1000);

        
    });
    
     
    
</script>
