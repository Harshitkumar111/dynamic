@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Change Password</h4><br><br>

@if(count($errors))
    @foreach ($errors->all() as $error)
        <p class="alert alert-danger alert-dismissible fade show">{{$error}}</p>
    @endforeach
@endif



                    <form method="post" action="{{ route('update.password')}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Old Passowrd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" id="oldpassword" name="oldpassword"  >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">New Passowrd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="newpassword" id="newpassword">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Confirm New Passowrd</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="confirm_password" id="confirm_password">
                            </div>
                        </div>
                      
                       
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Change Password">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    



@endsection