<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Edit Branch</h1>
</div>
<div class="col-md-12" style="">

    <div class="col-md-4 offset-md-4"  style="height: auto;border-radius: 10px;box-shadow: 0 10px 25px rgba(0,0,0,0.25);padding:20px 20px;border: 2px solid #333;margin-top: 200px;background-color: white">
       
            <form action="/branches/edit" method="POST">
                @csrf
                <input type="hidden" value="{{$data['branchdata']->id}}" name="id" id="id">
                <label>Address</label>
                <input type="text" name="address" value="{{$data['branchdata']->address}}" id="address" class="form-control" required><br>
                <label>Contact</label>
                <input type="text" name="contact" id="contact" value="{{$data['branchdata']->contact}}" class="form-control" required><br>
                <label>Status</label>
                <input type="hidden" value="{{$data['branchdata']->status}}" name="hiddenstatus" id="hiddenstatus">
                <select name="status" id="status" class="form-control">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select><br>
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
            </form>
        
    </div>

</div>
<x-footer/> 
@foreach ($data['userdata'] as $user)
<x-header data="{{$user->name}}"/> 
@endforeach

<script>
    $(document).ready(function () {
        const x=document.getElementById("hiddenstatus").value;
        $("#status").val(x);
    });
</script>