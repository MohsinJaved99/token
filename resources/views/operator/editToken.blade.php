<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
  <div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Edit Token</h1>
</div>


<div class="col-md-4 offset-md-4 rounded shadow" style="background-color: white;margin-top: 200px;padding-top: 20px">
    
    <form action="/editToken" method="POST">
        @csrf
        @foreach ($data['counterdata'] as $countersss)
        <input type="hidden" name="id" value="{{$countersss->id}}">
        <label>Customer Name</label>
        <input type="text" name="customer_name" value="{{$countersss->customer_name}}" id="customer_name" class="form-control" required><br>
        <label>Customer Number</label>
        <input type="text" name="customer_number" value="{{$countersss->customer_number}}" id="customer_number" class="form-control" required><br>
        <input type="submit" value="Update" class="btn btn-primary"><br><br>
        @endforeach
    </form>
    
</div>

<x-footer/> 
@foreach ($data['userdata'] as $user)
<x-header data="{{$user->name}}"/>
<input type="hidden" value="{{$user->branch_id}}" name="" id="bid">   
@endforeach
<script>
  
</script>


