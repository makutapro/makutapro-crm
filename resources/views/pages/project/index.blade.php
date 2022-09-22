@extends('layouts.simple.master')
@section('title', 'Project List')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Project List</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Project</li>
<li class="breadcrumb-item active">Project List</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row project-cards">
      <div class="col-md-12 project-list">
         <div class="card">
            <div class="row">
               <div class="col-md-6">
                  <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                     <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>All</a></li>
                     <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Doing</a></li>
                     <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Done</a></li>
                  </ul>
               </div>
               <div class="col-md-6">
                  <div class="form-group mb-0 me-0"></div>
                  <a class="btn btn-primary" href="{{ route('project.create') }}"> <i data-feather="plus-square"> </i>Create New Project</a>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body">
               <div class="tab-content" id="top-tabContent">
                  <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                     <div class="row">
                        @forelse ($data as $item)
                        <div class="col-xxl-4 col-lg-6">
                           <div class="project-box shadow shadow-showcase">
                              @if ($item->active == 1)
                              <span class="badge badge-primary">Doing</span>
                              @else
                              <span class="badge badge-success">Done</span>
                              @endif
                              <h6>{{$item->nama_project}}</h6>
                              <div class="media">
                                 <img class="img-20 me-1 rounded-circle" src="{{asset('assets/images/user/3.jpg')}}" alt="" data-original-title="" title="">
                                 <div class="media-body">
                                    <p>Pic : {{$item->pic == null ? '-' : $item->pic}}</p>
                                 </div>
                              </div>
                              <p>{{$item->description}}</p>
                              <div class="row details">
                                 <div class="col-6"><span>New </span></div>
                                 <div class="col-6 {{$item->active == 1 ? 'text-primary' : 'text-success'}} ">{{$item->new}} </div>
                                 <div class="col-6"> <span>Process</span></div>
                                 <div class="col-6 {{$item->active == 1 ? 'text-primary' : 'text-success'}}">{{$item->process}}</div>
                                 <div class="col-6"> <span>Closing</span></div>
                                 <div class="col-6 {{$item->active == 1 ? 'text-primary' : 'text-success'}}">{{$item->closing}}</div>
                                 <div class="col-6"> <span>Not Interested</span></div>
                                 <div class="col-6 {{$item->active == 1 ? 'text-primary' : 'text-success'}}">{{$item->notinterested}}</div>
                              </div>
                              <div class="project-status mt-4">
                                 <div class="media mb-0">
                                    <div class="media-body text-end"><span>Done</span></div>
                                 </div>
                                 @if ($item->active == 1)
                                 <div class="progress" style="height: 5px">
                                    <div class="progress-bar-animated bg-primary progress-bar-striped" role="progressbar" style="width: 70%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 @else
                                 <div class="progress" style="height: 5px">
                                    <div class="progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                 @endif
                              </div>
                           </div>
                        </div>
                        @empty
                            <p class="text-center">Project Not Available, Create one!</p>
                        @endforelse
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/typeahead/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.bundle.js')}}"></script>
<script src="{{asset('assets/js/typeahead/typeahead.custom.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/handlebars.js')}}"></script>
<script src="{{asset('assets/js/typeahead-search/typeahead-custom.js')}}"></script>
<script src="{{asset('assets/js/modal-animated.js')}}"></script>
@endsection