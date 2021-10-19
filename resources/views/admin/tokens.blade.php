<x-head/>

<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .hidden div {
        margin-top: 10px;
        font-family: 'calibri'
    }
    .hidden div .relative {
        display: none
    }
    nav div a {
        border-radius: 10px;
        font-family: 'calibri'
    }
    nav div span {
        border-radius: 10px;
        font-family: 'calibri'
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script type="text/javascript">
    $(document).ready( function () {
    $('#table_id').DataTable();
    });
</script>
@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp


<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Tokens</h1>
</div>
<input type="hidden" value="{{ session('adminid') }}" id="companyid">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-10 offset-md-1 rounded shadow" style="background-color: rgb(255, 255, 255);height: auto;margin-top: 200px;padding: 20px">
        {{-- <div class="col-md-12">
            <h4 style="float: right">Total Collection : <span id="total">...</span></h4>
        </div> --}}
        {{-- <div class="dol-md-12">
            <div class="row">
                <div class="col-md-4">
                    <h5>Search <a href="#" data-toggle="popover" title="Search By" data-content="Branch Name/Customer Name/Contact/Time/Date (Y-m-d) format"><i class="fa fa-lightbulb"></i></a></h5>
                    <input id="myInput" type="text" class="form-control" placeholder="Search..">
                </div>
            </div>
            
        </div><br> --}}
        <div class="col-md-12">
            <table class="table table-bordered" id="table_id">
                <thead>
                    <th>Branch</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Number</th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Price</th>
                </thead>
                <tbody>
                        @foreach ($data['branchdata'] as $dataa)
                        <tr>
                            <td>{{$dataa->address}}</td>
                            <td>{{$dataa->customer_name}}</td>
                            <td>{{$dataa->customer_number}}</td>
                            <td>{{$dataa->token_number}}</td>
                            <td>{{$dataa->token_time}}</td>
                            <td><?php if($dataa->day<10) {
                                echo "0".$dataa->day;
                                }else 
                                {
                                    echo $dataa->day;
                                }?>-{{$months[$dataa->month]}}-{{$dataa->year}}</td>
                            <td>{{$dataa->token_price}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>


<x-footer/> 
@foreach ($data['userdata'] as $user)
    <x-header data="{{ $user->name }}" />
@endforeach


<script>

        // var id = document.getElementById("companyid").value;
      
        // $('#myInput').on('input',function(e){
        // var search = document.getElementById("myInput").value;
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-Token': $('meta[name=_token]').attr('content')
        //     }
        // });
        // jQuery.ajax({
        //         url: 'getbranchfortoken/' + id +"/" + search,
        //         type: 'GET',
        //         data: {},
        //         success: function(data) {
        //             if (data != "") {
        //                 $('#myTable').html(data['response']);
        //                 // $('#total').html(data['sum'] + "Rs");

        //             } else {
        //                 $('#myTable').html(
        //                     "<tr><td colspan='6' style='text-align:center'>No Token Entry Found</td></tr>"
        //                     );
        //             }
        //         },
        //         error: function() {
        //             console.log("xhr=");
        //         }
        //     });
        // });


</script>
