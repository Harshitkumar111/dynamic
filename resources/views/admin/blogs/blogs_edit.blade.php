

@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>
<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Blogs Page</h4>
                    <form method="POST" action="{{ route('update.blog',$editblog->id)}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $editblog->blog_category_id ? 'selected' : '' }} >{{ $cat->blog_category }}</option>
                                    @endforeach
                                    </select>
                                @error('blog_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input name="blog_title" value="{{ $editblog->blog_title }}" class="form-control" type="text" id="example-text-input"> 
                                @error('blog_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                            <div class="col-sm-10">
                                <input name="blog_tags" value="{{ $editblog->blog_tags }}" class="form-control" type="text" data-role="tagsinput"> 
                                @error('blog_tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                      
                       
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                            <div class="col-sm-10">
                                <textarea id="elm1" name="blog_description">{{ $editblog->blog_description}}</textarea>
                                @error('blog_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="blog_image" id="blog_image" >
                                @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{ asset($editblog->blog_image)}}" alt="Card image cap">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Blogs Data">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    
<script type="text/javascript">

$(document).ready(function(){
    $('#blog_image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
});

</script>




@endsection