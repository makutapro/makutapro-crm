@extends('layouts.simple.master')
@section('title', 'Validation Forms')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Validation Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Form Controls</li>
<li class="breadcrumb-item active">Validation Forms</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Project Detail</h5>
					<span>For change name of project</span>
				</div>
				<div class="card-body">
					<form method="POST" action="{{route('project.update',$project->id)}}" role="form">
                        @method('PUT')
                        @csrf
						<div class="row">
							<div class="col-md-4 mb-3">
								<label for="validationCustom01">Kode Project</label>
								<input class="form-control" id="validationCustom01" type="text" required="" name="kode_project" value="{{$project->kode_project}}" disabled>
							</div>
							<div class="col-md-4 mb-3">
								<label for="validationCustom02">Nama Project</label>
								<input class="form-control" id="validationCustom02" type="text" required="" name="nama_project" value="{{$project->nama_project}}">
							</div>
							<div class="col-md-4 mb-3">
								<label for="validationCustom02"></label>
								<div class="input-group">
                                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                                </div>
                            </div>
						</div>
					</form>
				</div>
			</div>
		</div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
					<h5>Prospect Project</h5>
					<span>For move between Project. Filter first, then select leads and project which you want to move.</span>
                </div>
                <div class="card-body">
					<div class="table-responsive">
						<table class="display datatables" id="prospect-project-datatable">
							<thead>
								<tr>
									{{-- <th>No</th> --}}
									<th>ID</th>
									<th>Nama & No Hp</th>
									<th>Source</th>
									<th>Plarform</th>
									<th>Campaign</th>
									<th>Project</th>
									<th>Agent & Sales</th>
									<th>Status</th>
									<th>Input Date</th>
									<th>Process Date</th>
									{{-- <th>Closing</th> --}}
									{{-- <th>Action</th> --}}
								</tr>
							</thead>
							<tfoot>
								<tr>
									{{-- <th>No</th> --}}
									<th>ID</th>
									<th>Nama & No Hp</th>
									<th>Source</th>
									<th>Plarform</th>
									<th>Campaign</th>
									<th>Project</th>
									<th>Agent & Sales</th>
									<th>Status</th>
									<th>Input Date</th>
									<th>Process Date</th>
									{{-- <th>Closing</th> --}}
									{{-- <th>Action</th> --}}
								</tr>
							</tfoot>
						</table>
					</div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/form-validation-custom.js')}}"></script><script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

@endsection