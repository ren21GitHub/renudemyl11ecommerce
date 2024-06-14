@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
      <h1>Slider</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Manage Website</a></div>
        <div class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">Slider</a></div>
        <div class="breadcrumb-item">Create Slider</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Slider</h4>
              <div class="card-header-action">
                  {{-- <a href="{{route('admin.slider.create')}}" class="btn btn-primary">Create New</a> --}}
              </div>
            </div>
            <div class="card-body">
                <form action="{{route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Banner</label>
                        <input type="file" name="banner" value="{{old('banner')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <input type="text" name="type" value="{{old('type')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Starting Price</label>
                        <input type="text" name="starting_price" value="{{old('starting_price')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Button Url</label>
                        <input type="text" name="btn_url" value="{{old('btn_url')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Serial</label>
                        <input type="text" name="serial" value="{{old('serial')}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Status</label>
                        <select id="inputState" name="status" value="{{old('status')}}" class="form-control">
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