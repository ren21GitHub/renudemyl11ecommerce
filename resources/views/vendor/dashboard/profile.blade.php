@extends('vendor.dashboard.layouts.master')

@section('content')
    
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
      @include('vendor.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> profile</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>Update information</h4>
                  
                  <form method="POST" action="{{route('vendor.profile.update')}}" enctype="multipart/form-data"> 
                    @csrf    
                    @method('PUT')
                        <div class="col-md-12">
                          <div class="col-md-2">
                            <div class="wsus__dash_pro_img">
                              <img src="{{Auth::user()->image ? asset(Auth::user()->image) : asset('frontend/images/ts-2.jpg')}}" alt="img" class="img-fluid w-100">
                              <input name="image" type="file">
                            </div>
                          </div>
                          <div class="col-md-12 mt-4">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-user-tie"></i>
                              <input id="name" name="name" value="{{Auth::user()->name}}" type="text">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="wsus__dash_pro_single">
                              <i class="fal fa-envelope-open"></i>
                              <input id="email" name="email" value="{{Auth::user()->email}}" type="email">
                            </div>
                          </div> 
                        </div>
                      <div class="col-xl-12">
                        <button class="common_btn mb-4 mt-2" type="submit">Update Profile</button>
                      </div>
                  </form>
                <h4>Update password</h4>
                  <form method="POST" action="{{route('vendor.password.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="wsus__dash_pass_change mt-2">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-unlock-alt"></i>
                            <input name="current_password" type="password" placeholder="Current Password">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input name="password" type="password" placeholder="New Password">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-lock-alt"></i>
                            <input name="password_confirmation" type="password" placeholder="Confirm Password">
                          </div>
                        </div>
                        <div class="col-xl-12">
                          <button class="common_btn" type="submit">Change Password</button>
                        </div>
                      </div>
                    </div>
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