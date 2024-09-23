@extends('vendor.layouts.master')

@section('content')
<!-- Main Content -->
<section id="wsus__dashboard">
    <div class="container-fluid">
      
        @include('vendor.layouts.sidebar')

        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                <div class="dashboard_content  mt-2 mt-md-0">
                    <h3><i class="far fa-user"></i> Vendor Product Variant Item</h3>
                    <div class="wsus__dashboard_profile">
                        <div class="wsus__dash_pro_area">
                            <h4>Create Vendor Product Variant Item</h4>
                            <br/>
                            <form action="{{route('vendor.products-variant-item.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group wsus__input">
                                    <label>Variant Name</label>
                                    <input type="text" name="variant_name" value="{{$variant->name}}" class="form-control" readonly>
                                </div>

                                <div class="form-group wsus__input">
                                    <input type="hidden" name="product_id" value="{{$product->id}}" class="form-control" readonly>
                                </div>

                                <div class="form-group wsus__input">
                                    <input type="hidden" name="variant_id" value="{{$variant->id}}" class="form-control" readonly>
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>

                                <div class="form-group wsus__input">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" name="price" value="{{old('price')}}" class="form-control">
                                </div>
                                
                                <div class="form-group wsus__input">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" name="is_default" class="form-control">
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group wsus__input">
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
    </div>
</section>

@endsection