

@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Bloge Category</h4>
                    <form method="POST" action="{{ route('update.blog.category',$editblogcategory->id)}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="blog_category" id="blog_category"  value="{{ $editblogcategory->blog_category}}">
                                @error('blog_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                   
                  
                        
                    
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit Blog Category Data">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    





@endsection