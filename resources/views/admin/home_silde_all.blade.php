@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Home Slide Page</h4>
                    <form method="POST" action="{{ route('update.silder',$homesilde->id)}}"  enctype="multipart/form-data" >
                       @csrf
                       {{-- <input type="hidden" id="id"  value="{{ $homesilde->id }}"> --}}
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="title" id="title" value="{{$homesilde->title}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="short_title" id="short_title" value="{{$homesilde->short_title}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Video URL</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="video_url" id="video_url" value="{{$homesilde->video_url}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Silder Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="home_slide" id="home_slide" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($homesilde->home_slide))? url( $homesilde->home_slide):url('upload/no_image.jpg') }}" alt="Card image cap">

                                {{-- <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($homeslide->home_slide))? url( $homeslide->home_slide):url('upload/no_image.jpg') }}" alt="Card image cap"> --}}
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Silder">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    
<script type="text/javascript">

$(document).ready(function(){
    $('#home_slide').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
});

</script>


@endsection