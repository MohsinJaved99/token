<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Dashboard
    @foreach ($userdata as $user)
    <p style="text-align: center;font-size: 12px"><span style="text-transform: uppercase">{{$user->company}}</span> ({{$user->branch}})</p>
    @endforeach
</h1>
</div>

<!-- Modal -->
<div id="newtoken" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Create Token</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="/index/new" method="POST">
            @csrf
            <label>Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required><br>
            <label>Customer Number</label>
            <input type="text" name="customer_number" id="customer_number" class="form-control" required><br>
            <label>Token Charges</label>
            <input type="text" name="token_price" id="token_price" class="form-control" required><br>
            <input type="submit" name="submit" id="submit" value="Create" class="btn btn-dark">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="col-md-10 offset-md-1 col-sm-12 rounded shadow" style="background-color: white;margin-top: 200px;padding-top: 20px">
        <div class="col-md-12 col-sm-12" style="">
          
           
            <button class="btn btn-primary" data-toggle="modal" data-target="#newtoken"><i style="font-size: 15px;margin-top: 0px;color:rgb(248, 248, 248);margin-right: 5px" class="fa fa-plus-square" aria-hidden="true"></i>Create New Token</button>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4" style="height: 100%;border-radius: 10px;box-shadow: 0 10px 25px rgba(0,0,0,0.25);padding:10px 10px;border: 2px solid #333;margin-left: 15px;margin-right: 15px;margin-top: 20px;margin-bottom: 30px">
                <h4 style="text-align: center">COUNTER</h4>
                <p style="float: right"><b>Time:</b> <span id="time"></span></p>
                <p><b>Date:</b> <?php echo date("d-M-Y") ?></p>
                <p style="text-align: center">Total Tokens: <strong><span id="totalTokens">-</span></strong></p>
                <hr style="width: 60%">
                <p style="text-align: center;font-weight: 500;font-size: 18px;margin-bottom: -30px">Active Token</p>
                <h2 style="text-align: center;font-size: 8.5em" id="activetoken">
                    -
                </h2>
                <hr style="width: 60%;margin-top: -25px">
                <button style="float: right" class="btn btn-dark" title="Next Token" id="next">Next</button>
                <button class="btn btn-dark" style="margin-bottom: 10px" title="Previous Token" id="back">Previous</button>
            </div>
            
            <div class="col-lg-8 col-md-7" style="height: auto;margin-top: 20px;margin-bottom: 30px;margin-bottom: 20px;overflow-x: scroll;height: 100%;">
                <h4 class="text-small">TODAY'S TOKENS</h4>
                <table class="table table-hover table-striped table-responsive-md">
                    <thead>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Number</th>
                        <th>link</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th colspan="2">Operations</th>
                    </thead>
                    <tbody id="tabledata">
                        <tr>
                            <td colspan="7" style="text-align: center;font-weight: bold">Loading Data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       
    </div>

    <x-footer/> 
@foreach ($userdata as $user)
<x-header data="{{$user->name}}"/>
<input type="hidden" value="{{$user->branch_id}}" name="" id="bid">   
@endforeach
<script>
    
    $( document ).ready(function() {
        var id=document.getElementById("bid").value;
        $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        window.setInterval(function(){
           
           
            jQuery.ajax({
                url:'getTotaltoken/'+id,
                type: 'GET',
                data: {},
                success: function( data ){
                    $('#totalTokens').html(data)
                },
                error: function () {
                    console.log("xhr=");
                }
            });

            jQuery.ajax({
                url:'getBranchToken/'+id,
                type: 'GET',
                data: {},
                success: function( data ){
                    if(data!=""){
                        $('#tabledata').html(data);
                    }
                    else {
                        $('#tabledata').html("<tr><td colspan='7' style='text-align:center'>No Token Entry Found</td></tr>");
                    }
                },
                error: function () {
                    console.log("xhr=");
                }
            });


            jQuery.ajax({
                url:'getActiveToken/'+id,
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

        let _token   = $('meta[name="csrf-token"]').attr('content');
        $("#next").click(function(e){
           
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"{{ route('next') }}",
            data:{id:id,_token: _token},
            success:function(data){
                swal("", data.success, "success");
            },
            error: function (er) {
                    console.log("xhr="+er.error);  
            }
        });

        });

        $("#back").click(function(e){
           
           e.preventDefault();
           $.ajax({
               type:'POST',
               url:"{{ route('back') }}",
               data:{id:id,_token: _token},
               success:function(data){
                swal("", data.success, "success");
               },
               error: function (er) {
                       console.log("xhr="+er.error);  
               }
           });
   
           });
    
        //     $.ajaxSetup({
        //         headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        //     });
        //    jQuery.ajax({
        //         url:'nextToken',
        //         type: 'POST',
        //         data: {id,id},
        //         success: function(data){
        //             alert(data);
        //         },
        //         error: function () {
        //             console.log("xhr=");
        //         }
        //     });


        function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function startTime() {
  var date = new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  document.getElementById('time').innerHTML = strTime;
  t = setTimeout(function() {
    startTime()
  }, 500);
}
startTime();
        
    });
    
   
</script>


