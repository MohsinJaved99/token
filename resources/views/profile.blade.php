<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
@foreach ($userdata as $user)
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Profile</h1>
</div>

    


    <div class="modal" id="changepw">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <form action="/changepassword" method="POST">
                    @csrf
                    <input type="hidden" value="{{$user->id}}" name="id" id="id">
                    <input type="hidden" value="{{$user->user_id}}" name="user_id" id="user_id">
                    <input type="hidden" value="{{$user->role_id}}" name="role_id" id="role_id">
                    <label>Old Password</label>
                    <input type="password" name="old_password" value="" id="old_password" class="form-control" required><br>
                    <label>New Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control" required><br>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control" required><br>
                    
                    <input type="submit" name="submit" value="Change Password" class="btn btn-primary" style="float: right">
                </form>
            </div>
      
      
          </div>
        </div>
      </div>
 
   
     
<div class="col-md-12">
   
    <div class="col-md-4 offset-md-4 rounded shadow"  style="height: auto;padding:20px 20px;margin-top: 200px;background-color: white">
        @error('confirm_password')
        <div class="col-md-12" style="position: absolute;top: 80px">
                <div class="alert alert-danger">
                    {{$message}}
                </div>
        </div>
        @enderror
        <div class="col-md-12">
            @if(session()->has('success'))
                @if($message="Old Password Do Not Match.")
                    <div class="alert alert-danger">
                        <strong>Error!</strong> {{session()->get('success')}}
                    </div>
                @else
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{session()->get('success')}}
                    </div>
                @endif
            @endif
        </div>
            <form action="/profile" method="POST">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id" id="id">
                <input type="hidden" value="{{$user->user_id}}" name="user_id" id="user_id">
                <input type="hidden" value="{{$user->role_id}}" name="role_id" id="role_id">
                <label>Name</label>
                <input type="text" name="name" value="{{$user->name}}" id="name" class="form-control" required><br>
                @if ($user->role_id=="2")
                    <label>Contact</label>
                    <input type="number" name="contact" value="{{$user->contact}}" id="contact" class="form-control" required><br>
                    <label>Cnic</label>
                    <input type="number" name="cnic" value="{{$user->cnic}}" id="cnic" class="form-control" required><br>
                @endif
                <label>Email</label>
                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" required><br>

                <input type="submit" name="submit" value="Update" class="btn btn-primary" style="float: right">
            </form>
        <button class="btn btn-light" style="margin-top: -15px" data-toggle="modal" data-target="#changepw">Change Password</button>
    </div>


</div>

<x-footer/> 
<x-header data="{{$user->name}}"/>
@endforeach