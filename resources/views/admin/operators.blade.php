<x-head/>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
  </div>
<div class="col-md-12" style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0;z-index: 0;">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Operators</h1>
</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>

<?php 

$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

?>

<div class="offset-md-1 col-md-10 rounded shadow" style="background-color: rgb(255, 255, 255);height: auto;padding: 20px;margin-top: 200px">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{session()->get('success')}}
                </div>
            @endif
        </div>
        <div class="col-md-4" style="margin-top: 20px;margin-bottom: 20px">
            <h3 style="text-align: center">Create New Operator</h3>
            <hr style="width: 50%">
            <form action="/operators" method="POST">
                @csrf
                <label>Name <span style="color: red">*</span></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required><br>
                <label>Contact <span style="color: red">*</span></label>
                <input type="number" name="contact" id="contact" class="form-control" placeholder="Enter Contact Number" required><br>
                <label>Cnic <span style="color: red">*</span></label>
                <input type="number" name="cnic" id="cnic" class="form-control" placeholder="Enter Contact Number" required><br>
                <label>Email <span style="color: red">*</span></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" required><br>
                <label>Password <span style="color: red">*</span></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required><br>
                <label>branch <span style="color: red">*</span></label>
                <select name="branch_id" id="branch_id" class="form-control" required >
                    @foreach ($data['branches'] as $branch)
                        <option value="{{$branch->id}}">{{$branch->address}}</option>
                    @endforeach
                </select><br>
                <input type="submit" name="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-8" style="margin-top: 20px;margin-bottom: 20px;overflow-x: scroll;height: 100%;">
            <h3 style="text-align: center">Operators</h3>
            <table class="table table-bordered" id="table_id">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Branch</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                   
                </thead>
                <tbody>
                        @foreach ($data['operatordata'] as $operators)
                            <tr>
                                <td>{{$operators->name}}</td>
                                <td>{{$operators->email}}</td>
                                <td>{{$operators->contact}}</td>
                                <td>{{$operators->address}}</td>
                                <td><?php if($operators->day<10) {
                                    echo "0".$operators->day;
                                    }else 
                                    {
                                        echo $operators->day;
                                    }?>-{{$months[$operators->month]}}-{{$operators->year}}</td>
                                <td>{{$operators->status}}</td>
                                <td><a href="/operator/active/{{$operators->id}}"><button class="btn btn-primary">Acitve</button></a></td>
                                <td><a href="/operator/delete/{{$operators->id}}"><button class="btn btn-danger">Inactive</button></a></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-footer/> 
@foreach ($data['userdata'] as $user)
<x-header data="{{$user->name}}"/> 
@endforeach