@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Profile</h4>
                    <form method="POST" action="{{ route('store.profile')}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" id="example-text-input" value="{{$editData->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" name="email" id="example-text-input" value="{{$editData->email}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">User Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="username" id="example-text-input" value="{{$editData->username}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="profile_image" id="image" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                <img class="rounded avatar-xl" id="showImage" src="{{ (!empty($editData->profile_image))? url('upload/admin_profile_image/'.$editData->profile_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Profile">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    
<script type="text/javascript">

$(document).ready(function(){
    $('#image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
});

</script>


@endsection