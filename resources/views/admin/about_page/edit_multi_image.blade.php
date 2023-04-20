

@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Multi Image</h4> <br><br>
                    <form method="POST" action="{{ route('update.multi.image',$editimage->id)}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">About Multi Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="multi_image" id="multi_image">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{ asset($editimage->multi_image) }}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Mutli Image">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    
<script type="text/javascript">

$(document).ready(function(){
    $('#multi_image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
});

</script>




@endsection