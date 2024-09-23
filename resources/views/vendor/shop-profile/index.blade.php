@extends('vendor.layouts.master')

@section('content')
    
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Shop profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Update information</h4>
                  <form action="{{route('vendor.shop-profile.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group wsus__input">
                    <label>Preview</label>
                    <img src="{{asset($profile->banner)}}" width="200" alt="">
                </div>
                  <div class="form-group wsus__input">
                      <label>Banner</label>
                      <input type="file" name="banner" value="{{old('banner')}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                    <label>Shop Name</label>
                    <input type="text" name="shop_name" value="{{$profile->shop_name}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                      <label>Phone</label>
                      <input type="text" name="phone" value="{{$profile->phone}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                      <label>Email</label>
                      <input type="text" name="email" value="{{$profile->email}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                      <label>Address</label>
                      <input type="text" name="address" value="{{$profile->address}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                      <label>Description</label>
                      <textarea name="description" class="summernote">{{$profile->description}}</textarea>
                  </div>
                  <div class="form-group wsus__input">
                      <label>Facebook</label>
                      <input type="text" name="fb_link" value="{{$profile->fb_link}}" class="form-control">
                  </div>
                  <div class="form-group wsus__input">
                    <label>Twitter</label>
                    <input type="text" name="tw_link" value="{{$profile->tw_link}}" class="form-control">
                </div>
                <div class="form-group wsus__input">
                  <label>Instagram</label>
                  <input type="text" name="insta_link" value="{{$profile->insta_link}}" class="form-control">
              </div>
                  <button type="submit" class="btn btn-primary">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->

@endsection