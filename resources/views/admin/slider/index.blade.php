@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
    <section class="section">
      <div class="section-header">
        <h1>Slider</h1>
        {{-- <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Manage Website</a></div>
          <div class="breadcrumb-item">Slider</div>
        </div> --}}
      </div>

      <div class="section-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>Slider</h4>
                <div class="card-header-action">
                    <a href="{{route('admin.slider.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New</a>
                </div>
              </div>
              <div class="card-body">
                {{ $dataTable->table() }}
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush