<x-head />
<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
<div class="preloader">
    <img src="https://i.pinimg.com/originals/96/27/ba/9627baf241edb820aa70797c3c2f6320.gif">
</div>
<div class="col-md-12"
    style="background-image:url('{{ URL::to('/') }}/images/1077.jpg');background-size:cover;height: 300px;font-size: 10em;color: white;text-align: center;position: absolute;top: 0">
    <h1 style="margin-top:120px;letter-spacing: 1px;font-family: Verdana, Geneva, Tahoma, sans-serif">Operators</h1>
</div>
<?php

$months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'];

?>

<div class="offset-md-1 col-md-10 rounded shadow"
    style="background-color: rgb(255, 255, 255);height: auto;padding: 20px;margin-top: 200px">
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <div class="col-md-4" style="margin-top: 20px;margin-bottom: 20px">
            <h3 style="text-align: center">Create New Branch</h3>
            <hr style="width: 50%">
            <form action="/branches" method="POST">
                @csrf
                <label>Address <span style="color: red">*</span></label>
                <input type="text" name="address" id="address" class="form-control" required><br>
                <label>Contact <span style="color: red">*</span></label>
                <input type="text" name="contact" id="contact" class="form-control" required><br>
                <input type="submit" name="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
        <div class="col-md-8" style="margin-top: 20px;margin-bottom: 20px;overflow-x: scroll;height: 100%;">
            <h3 style="text-align: center">Branches</h3>

            <table id="table_id" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['branchdata'] as $branch)
                        <tr>
                            <td>{{ $branch->addreess }}</td>
                            <td>{{ $branch->contaact }}</td>
                            <td><?php if($branch->day<10) {
                                echo "0".$branch->day;
                                }else 
                                {
                                    echo $branch->day;
                                }?>-{{ $months[$branch->month] }}-{{ $branch->year }}</td>
                            <td>{{ $branch->status }}</td>
                            <td><a href="/branches/edit/{{ $branch->id }}"><button
                                        class="btn btn-primary">Edit</button></a></td>
                            <td><a href="/branches/delete/{{ $branch->id }}"><button
                                        class="btn btn-danger">Inactive</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<x-footer />
@foreach ($data['userdata'] as $user)
    <x-header data="{{ $user->name }}" />
@endforeach
