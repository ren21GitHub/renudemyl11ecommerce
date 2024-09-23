@extends('vendor.layouts.master')

@section('content')
<!-- Main Content -->
<section id="wsus__dashboard">
    <div class="container-fluid">
      
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content  mt-2 mt-md-0">
                    <a href="{{route('vendor.products-variant.index', ['product' => $productVariant->product_id])}}" class="btn btn-warning"> <i class="fas fa-long-arrow-alt-left"></i> Back</a>
                    <h3><i class="far fa-user"></i> Update Product Variant</h3>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <h4>Update Product Variant</h4>
                            <form action="{{route('vendor.products-variant.update', $productVariant->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group wsus__input">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$productVariant->name}}" class="form-control">
                                </div>

                                <div class="form-group wsus__input">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" name="status" class="form-control">
                                        <option {{$productVariant->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$productVariant->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection