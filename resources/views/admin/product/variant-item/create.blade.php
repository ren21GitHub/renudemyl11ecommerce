@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
      <h1>Product Variant Item</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Product Variant Item</h4>
              <div class="card-header-action">
              </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.products-variant-item.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Variant Name</label>
                        <input type="text" name="variant_name" value="{{$variant->name}}" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="variant_id" value="{{$variant->id}}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Price <code>(Set 0 for make it free)</code></label>
                        <input type="text" name="price" value="{{old('price')}}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="inputState">Is Default</label>
                        <select id="inputState" name="is_default" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" name="status" class="form-control">
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