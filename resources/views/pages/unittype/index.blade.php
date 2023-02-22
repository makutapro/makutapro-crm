@extends('layouts.simple.master')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset('dist/html/assets/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('dist/html/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('dist/html/assets/lib/datatables/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('dist/html/assets/lib/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/html/assets/css/app.css')}}" type="text/css" />
    <!-- Font Awesome -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="be-content">
    <div class="page-head">
        <div class="d-flex justify-content-between">
            <h2 class="page-head-title">Unit Type</h2>
            <div class="d-flex justify-content-between">
                <button class="btn btn-space md-trigger mr-1" style="background-color: #2A3F54;color:#fff;" data-modal="roascreate" data-bs-toggle="modal" data-bs-target="#newunit"><i class="icon icon-left mdi mdi-plus mb-1" ></i>Add New</i></button>
            </div>
        </div>
        {{-- Add Modal --}}
        {{-- <div class="modal-container colored-header colored-header-primary custom-width modal-effect-9" id="roascreate">
            <div class="modal-content" style="border-radius: 40px;">
                <div class="modal-header modal-header-colored" style="background-color: #6F9CD3; ">
                    <h2 class="modal-title" style="font-family: Montserrat ,
                    sans-serif Medium 500; font-size: 25px;"><strong>MAKUTA</strong> Pro</h2>
                    <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span class="mdi mdi-close"></span></button>
                </div>
                <form action="{{route('unittype.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body form">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Project</label>
                                        <select class="select2 form-control" name="ProjectCode" style="border-radius: 50px;" required>
                                            <option value=" ">Pilih Project</option>
                                            @foreach ($unittype as $item)
                                               <option value="{{$item->unit_name}}">{{$item->nama_project}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group my-2">
                                <div class="row">
                                    <div class="col">
                                        <label>Nama Unit</label>
                                        <input class="form-control" required style="border-radius: 50px;" type="text"  name="UnitName">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn  modal-close " style="background-color: #6F9CD3; border-radius: 50px; color: #fff;" type="submit">Save</button>
                </div>
                </form>
            </div>
        </div> --}}

        <div class="modal fade" id="newunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content"  style="border-radius: 20px;">
                  <div class="modal-header" style="background-color: #6F9CD3; border-top-left-radius: 20px;border-top-right-radius: 20px;">
                    <h2 class="modal-title text-white" style="font-family: Montserrat ,
                    sans-serif Medium 500; font-size: 25px;"><strong>MAKUTA</strong> Pro</h2>
                     <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{route('unittype.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Project</label>
                                            <select class="select2 form-control" name="project_id" style="border-radius: 50px;" required>
                                                <option value=" ">Pilih Project</option>
                                                @foreach ($projects as $project)
                                                   <option value="{{$project->id}}">{{$project->nama_project}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <div class="row">
                                        <div class="col">
                                            <label>Nama Unit</label>
                                            <input class="form-control" required style="border-radius: 50px;" type="text"  name="unit_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <div class="modal-footer">
                    <button class="btn  modal-close " style="background-color: #6F9CD3; border-radius: 50px; color: #fff;" type="submit">Save Change</button>
                  </div>
                  </form>
               </div>
            </div>
        </div>

        {{-- End Add Modal --}}
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('unittype.index')}}">Unit Type </a></li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        @if (session('status'))
        <div class="alert alert-contrast alert-success alert-dismissible" role="alert">
          <div class="icon"><span class="mdi mdi-check"></span></div>
          <div class="message">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close" aria-hidden="true"></span></button><strong>{{ session('status') }} </strong></div>
          </div>
        </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header text-center"><strong>{{Auth::user()->NamaPT}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="container py-2">
                            <table class="table table-sm table-hover table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">No.</th>
                                        <th>Nama Unit</th>
                                        <th>Project</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unittype as $item)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->unit_name}}</td>
                                        <td>{{$item->nama_project}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                            <button class="btn btn-rounded md-trigger mr-1" style="background-color: #2A3F54;color:#fff;" data-bs-toggle="modal" data-bs-target="#editunit{{$item->id}}"><i class="fa fa-eye"></i></button>

                                            <form action="{{route('unittype.destroy', $item->id)}}" method="post" onsubmit="return confirm('Apakah anda yakin ?')">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-rounded" style="background-color: #8A0512; color :#fff;" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                            </div>
                                        </td>

                                        <div class="modal fade" id="editunit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                               <div class="modal-content"  style="border-radius: 20px;">
                                                  <div class="modal-header" style="background-color: #6F9CD3; border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                                    <h2 class="modal-title text-white" style="font-family: Montserrat ,
                                                    sans-serif Medium 500; font-size: 25px;"><strong>MAKUTA</strong> Pro</h2>
                                                     <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                  </div>
                                                  <form action="{{route('unittype.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body form">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label>Project</label>
                                                                            <select class="select2 form-control" name="project_id" style="border-radius: 50px;" required>
                                                                                <option value=" ">Pilih Project</option>
                                                                                @foreach ($projects as $project)
                                                                                {{-- if($item->id == $project->id){
                                                                                    <option value="{{$item->project_id}}" selected>{{$item->project_id}}-{{$item->nama_project}}</option>
                                                                                }else{ --}}
                                                                                    <option value="{{$project->id}}" {{$item->project_id == $project->id ? 'selected': ''}}>{{$project->nama_project}}</option>

                                                                                {{-- } --}}
                                                                                @endforeach
              
                                                                                
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group my-2">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label>Nama Unit</label>
    
                                                                            <input class="form-control" required style="border-radius: 50px;" type="text"  name="unit_name" value="{{ old('unit_name', $item->unit_name) }}">
                                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                  <div class="modal-footer">
                                                    <button class="btn  modal-close " style="background-color: #6F9CD3; border-radius: 50px; color: #fff;" type="submit">Save Change</button>
                                                  </div>
                                                  </form>
                                               </div>
                                            </div>
                                        </div>
                                
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('footer')


<script src="{{asset('dist/html/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net/js/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/js/datatables-prospect.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //-initialize the javascript
        // App.init();
        App.dataTables();
    });
</script>


<script src="{{asset('dist/html/assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/bootstrap-slider/bootstrap-slider.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/jszip/jszip.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/pdfmake/pdfmake.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/pdfmake/vfs_fonts.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons/js/buttons.print.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/lib/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dist/html/assets/js/app-table-filters.js')}}" type="text/javascript"></script>

    <script src="{{asset('dist/html/assets/lib/jquery.niftymodals/js/jquery.niftymodals.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $.fn.niftyModal('setDefaults',{
            overlaySelector: '.modal-overlay',
            contentSelector: '.modal-content',
            closeSelector: '.modal-close',
            classAddAfterOpen: 'modal-show'
        });

        $(document).ready(function(){
            //-initialize the javascript
            // App.init();
        });
    </script>
@endsection

