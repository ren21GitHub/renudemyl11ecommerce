@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
      <h1>Product</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Product</h4>
              <div class="card-header-action">
              </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="thumb_image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Category</label>
                                <select id="inputState" name="category" class="form-control main-category">
                                  <option value="">Select</option>
                                  @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>   
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Sub Category</label>
                                <select id="inputState" name="sub_category" class="form-control sub-category">
                                  <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Child Category</label>
                                <select id="inputState" name="child_category" class="form-control child-category">
                                  <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputState">Brands</label>
                        <select id="inputState" name="brand" class="form-control">
                          <option value="">Select</option>
                          @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>   
                          @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" value="{{old('sku')}}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" value="{{old('price')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" name="offer_price" value="{{old('offer_price')}}" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Offer Start Date</label>
                                <input type="text" name="offer_start_date" value="{{old('offer_start_date')}}" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Offer End Date</label>
                                <input type="text" name="offer_end_date" value="{{old('offer_end_date')}}" class="form-control datepicker">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Stock Quantity</label>
                        <input type="number" min="0" name="qty" value="{{old('qty')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Video Link</label>
                        <input type="text" name="video_link" value="{{old('video_link')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Long Description</label>
                        <textarea name="long_description" class="form-control summernote"></textarea>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Is Top</label>
                                <select id="inputState" name="is_top" value="{{old('is_top')}}" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Is Best</label>
                                <select id="inputState" name="is_best" value="{{old('is_best')}}" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputState">Is Featured</label>
                                <select id="inputState" name="is_featured" value="{{old('is_featured')}}" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="form-group">
                        <label for="inputState">Product Type</label>
                        <select id="inputState" name="product_type" value="{{old('product_type')}}" class="form-control">
                            <option value="">Select</option>
                            <option value="new_arrival">New Arrival</option>
                            <option value="featured_product">Featured</option>
                            <option value="top_product">Top Product</option>
                            <option value="best_product">Best Product</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Seo Title</label>
                        <input type="text" name="seo_title" value="{{old('seo_title')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Seo Description</label>
                        <textarea name="seo_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" name="status" value="{{old('status')}}" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
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
            /* Get Sub Categories */
            $('body').on('change', '.main-category', function(e){
                $('.child-category').html('<option value="">Select</option>');
                
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: '{{route("admin.products.get-subcategories")}}',
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

            /* Get Child Categories */
            $('body').on('change', '.sub-category', function(e){
                
                let id = $(this).val();

                $.ajax({
                    method: 'GET',
                    url: '{{route("admin.products.get-childcategories")}}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id:id
                    },
                    dataType: 'json',
                    success: function(data){
                        $('.child-category').html('<option value="">Select</option>');

                        $.each(data, function(i, item){
                            // console.log(item.name);
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);
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