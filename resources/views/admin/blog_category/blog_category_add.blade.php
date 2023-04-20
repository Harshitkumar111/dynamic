

@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add Bloge Category</h4>
                    <form method="POST" id="myForm" action="{{ route('store.blog.category')}}"  enctype="multipart/form-data" >
                       @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10 form-group ">
                                <input class="form-control" type="text" name="blog_category" id="blog_category" >
                                @error('blog_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                   
                  
                        
                    
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Blog Category Data">
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    


<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                blog_category: {
                    required : true,
                }, 
            },
            messages :{
                blog_category: {
                    required : 'Please Enter Blog Category',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>



@endsection