

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
                    <form method="POST" action="{{ route('store.blog')}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="blog_category_id" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>

                                    @foreach ($blogcategory as $item)
                                        <option value="{{ $item->id }}">{{ $item->blog_category}}</option>
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
                                <input class="form-control" type="text" name="blog_title" id="blog_title" >
                                @error('blog_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                            <div class="col-sm-10">
                                <input class="form-control" value="home,tech" type="text" name="blog_tags" id="blog_tags" data-role="tagsinput" >
                                @error('blog_tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                      
                       
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                            <div class="col-sm-10">
                                <textarea id="elm1" name="blog_description"></textarea>
                                @error('blog_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="blog_image" id="blog_image">
                                @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                <img id="showImage" class="rounded avatar-lg" src="{{url('upload/no_image.jpg')}}" alt="Card image cap">
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