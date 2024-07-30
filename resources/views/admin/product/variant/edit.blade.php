@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
      <h1>Product Variant</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Update Product Variant</h4>
              <div class="card-header-action">
              </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.products-variant.update', $productVariant->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{$productVariant->name}}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" name="status" class="form-control">
                            <option {{$productVariant->status == 1 ? 'selected' : ''}} value="1">Active</option>
                            <option {{$productVariant->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection