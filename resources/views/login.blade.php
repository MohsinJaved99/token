<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Login</h1>
</div>




<div class="col-md-4 offset-md-4"
    style="margin-top: 150px;border-radius: 10px;box-shadow: 0 10px 45px rgba(0,0,0,0.15);padding:20px 20px;background-color: white;margin-top: 200px">
    <div class="col-md-12">
        @if(session()->has('success'))
            <div class="alert alert-danger">
                <strong>Error!</strong> {{session()->get('success')}}
            </div>
        @endif
    </div>

    <form action="login" method="POST">
        @csrf
        <label>Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email Address" required><br>
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
        <br>
        <input type="submit" name="login" id="login" value="Login" class="btn btn-primary" style="float: right"><br>
    </form>

</div>
<x-footer/>

<x-header data=""/>
