@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
      <h1>Child Category</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Create Child Category</h4>
                    <div class="card-header-action">
                    </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.child-category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="inputState">Category</label>
                                <select id="inputState" name="category" class="form-control main-category">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>                                    
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Sub Category</label>
                                <select id="inputState" name="sub_category" class="form-control sub-category">
                                <option value="">Select</option>
                                
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Child Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: '{{route("admin.get-subcategories")}}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id:id
                    },
                    dataType: 'json',
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>');

                        $.each(data, function(i, item){
                            // console.log(item.name);
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error:function(xhr, status, error){
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush