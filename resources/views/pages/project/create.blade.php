@extends('layouts.simple.master')
@section('title', 'Project List')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Project Create</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Project</li>
<li class="breadcrumb-item active">Project Create</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="form theme-form">
            <form action="{{route('project.store')}}" method="post">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Project Title</label>
                    <input class="form-control" type="text" placeholder="Project name *" name="nama_project" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Send By</label>
                    <select class="form-select" name="send_by">
                      <option value="sales">Sales</option>
                      <option value="agent">Agent</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div>
                    {{-- <button class="btn btn-success me-3 sweet-8" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-8']);">Add</button> --}}
					          <button class="btn btn-success sweet-8" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'sweet-8']);">Success</button>
                    <a class="btn btn-danger" href="{{route('project.index')}}">Cancel</a>
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
@endsection

@section('script')
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone-script.js')}}"></script>
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/app.js')}}"></script>
@endsection